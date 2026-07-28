<?php
/*************************************************************************************/
/*      This file is part of the Thelia package.                                     */
/*                                                                                   */
/*      Copyright (c) OpenStudio                                                     */
/*      email : dev@thelia.net                                                       */
/*      web : http://www.thelia.net                                                  */
/*                                                                                   */
/*      For the full copyright and license information, please view the LICENSE.txt  */
/*      file that was distributed with this source code.                             */
/*************************************************************************************/

declare(strict_types=1);

namespace NetReviews;

use NetReviews\Model\NetreviewsOrderQueueQuery;
use NetReviews\Model\NetreviewsProductReviewQuery;
use Propel\Runtime\Connection\ConnectionInterface;
use Symfony\Component\DependencyInjection\Loader\Configurator\ServicesConfigurator;
use Symfony\Component\Finder\Finder;
use Thelia\Core\Template\TemplateDefinition;
use Thelia\Log\Tlog;
use Thelia\Module\BaseModule;

class NetReviews extends BaseModule
{
    /** @var string */
    const DOMAIN_NAME = 'netreviews';

    const LAST_IMPORT_KEY = 'last_reviews_import';

    /** @var string */
    const UPDATE_PATH = __DIR__ . DS . 'Config' . DS . 'sql' . DS . 'update';

    public function postActivation(?ConnectionInterface $con = null): void
    {
        try {
            NetreviewsOrderQueueQuery::create()
                ->find();
        } catch (\Exception $exception) {
            $database = $this->resolveDatabase($con);
            $database->insertSql(null, [__DIR__ . "/Config/sql/netreviews_order_queue.sql"]);
        }

        try {
            NetreviewsProductReviewQuery::create()
                ->find();
        } catch (\Exception $exception) {
            $database = $this->resolveDatabase($con);
            $database->insertSql(null, [__DIR__ . "/Config/sql/netreviews_product_review.sql"]);
        }
    }

    public function update($currentVersion, $newVersion, ?ConnectionInterface $con = null): void
    {
        $finder = (new Finder())->files()->name('#.*?\.sql#')->sortByName()->in(self::UPDATE_PATH);

        if ($finder->count() === 0) {
            return;
        }

        $database = $this->resolveDatabase($con);

        /** @var \Symfony\Component\Finder\SplFileInfo $updateSQLFile */
        foreach ($finder as $updateSQLFile) {
            if (version_compare($currentVersion, str_replace('.sql', '', $updateSQLFile->getFilename()), '<')) {
                $database->insertSql(null, [$updateSQLFile->getPathname()]);
            }
        }
    }

    public function getHooks(): array
    {
        // Thelia 2 custom front hook points. In Thelia 3 (Flexy) these are unused — the
        // front is rendered by the theme through NetReviews\Twig\NetReviewsExtension — but
        // declaring them is harmless, so the module stays backward compatible with Thelia 2.
        return [
            [
                'type' => TemplateDefinition::FRONT_OFFICE,
                'code' => 'netreviews.tagmanager',
                'title' => ['en_US' => 'Tag manager for Verified Reviews', 'fr_FR' => 'Tag manager pour Avis Verifies'],
                'block' => false,
                'active' => true,
            ],
            [
                'type' => TemplateDefinition::FRONT_OFFICE,
                'code' => 'netreviews.site.widget',
                'title' => ['en_US' => 'Widget Site', 'fr_FR' => 'Widget Site'],
                'block' => false,
                'active' => true,
            ],
            [
                'type' => TemplateDefinition::FRONT_OFFICE,
                'code' => 'netreviews.product.iframe',
                'title' => ['en_US' => 'Iframe product', 'fr_FR' => 'Iframe produit'],
                'block' => false,
                'active' => true,
            ],
            [
                'type' => TemplateDefinition::FRONT_OFFICE,
                'code' => 'netreviews.footer.link',
                'title' => ['en_US' => 'Footer link', 'fr_FR' => 'Lien footer'],
                'block' => false,
                'active' => true,
            ],
        ];
    }

    /**
     * True on Thelia 3 (twig branch), false on Thelia 2. Used to gate the T3-only code paths
     * (default-twig hooks, Twig extension) so the module works on both versions.
     */
    public static function isThelia3(): bool
    {
        return class_exists(\Thelia\Core\Install\Database::class);
    }

    private function resolveDatabase(?ConnectionInterface $con): object
    {
        // Thelia 3 moved Database from Thelia\Install to Thelia\Core\Install.
        $class = self::isThelia3()
            ? \Thelia\Core\Install\Database::class
            : \Thelia\Install\Database::class;

        return new $class($con);
    }

    public static function log($msg)
    {
        $year = (new \DateTime())->format('Y');
        $month = (new \DateTime())->format('m');
        $logger = Tlog::getNewInstance();
        $logger->setDestinations("\\Thelia\\Log\\Destination\\TlogDestinationFile");
        $logger->setConfig(
            "\\Thelia\\Log\\Destination\\TlogDestinationFile",
            0,
            THELIA_ROOT . "log" . DS . "netreviews" . DS . $year.$month.".txt"
        );
        $logger->addAlert("MESSAGE => " . print_r($msg, true));
    }

    public static function configureServices(ServicesConfigurator $servicesConfigurator): void
    {
        $exclude = [
            __DIR__.'/I18n/*',
            // Declared (and wired) through Config/config.xml <hooks> — avoid a duplicate
            // autowired service definition for the same class.
            __DIR__.'/Hook/BackHook.php',
            __DIR__.'/Hook/FrontHook.php',
        ];

        // On Thelia 2, the default-twig back-office hooks and the Twig front stack depend on
        // Thelia 3-only services (TheliaFormFactory, the theme Twig runtime), so they must
        // not be wired there. On Thelia 3 everything is loaded.
        if (!self::isThelia3()) {
            $exclude[] = __DIR__.'/Hook/Back/*';
            $exclude[] = __DIR__.'/Twig/*';
            $exclude[] = __DIR__.'/Service/NetReviewsFrontRenderer.php';
        }

        $servicesConfigurator->load(self::getModuleCode().'\\', __DIR__)
            ->exclude($exclude)
            ->autowire(true)
            ->autoconfigure(true);
    }
}
