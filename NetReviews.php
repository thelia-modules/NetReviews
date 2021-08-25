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

namespace NetReviews;

use NetReviews\Model\NetreviewsOrderQueueQuery;
use NetReviews\Model\NetreviewsProductReviewQuery;
use Propel\Runtime\Connection\ConnectionInterface;
use Symfony\Component\DependencyInjection\Loader\Configurator\ServicesConfigurator;
use Symfony\Component\Finder\Finder;
use Thelia\Core\Template\TemplateDefinition;
use Thelia\Install\Database;
use Thelia\Log\Tlog;
use Thelia\Module\BaseModule;

class NetReviews extends BaseModule
{
    /** @var string */
    const DOMAIN_NAME = 'netreviews';

    const LAST_IMPORT_KEY = 'last_reviews_import';

    /** @var string */
    const UPDATE_PATH = __DIR__ . DS . 'Config' . DS . 'sql' . DS . 'update';

    public function postActivation(ConnectionInterface $con = null): void
    {
        try {
            NetreviewsOrderQueueQuery::create()
                ->find();
        } catch (\Exception $exception) {
            $database = new Database($con);
            $database->insertSql(null, [__DIR__ . "/Config/sql/netreviews_order_queue.sql"]);
        }

        try {
            NetreviewsProductReviewQuery::create()
                ->find();
        } catch (\Exception $exception) {
            $database = new Database($con);
            $database->insertSql(null, [__DIR__ . "/Config/sql/netreviews_product_review.sql"]);
        }
    }

    public function update($currentVersion, $newVersion, ConnectionInterface $con = null): void
    {
        $finder = (new Finder())->files()->name('#.*?\.sql#')->sortByName()->in(self::UPDATE_PATH);

        if ($finder->count() === 0) {
            return;
        }

        $database = new Database($con);

        /** @var \Symfony\Component\Finder\SplFileInfo $updateSQLFile */
        foreach ($finder as $updateSQLFile) {
            if (version_compare($currentVersion, str_replace('.sql', '', $updateSQLFile->getFilename()), '<')) {
                $database->insertSql(null, [$updateSQLFile->getPathname()]);
            }
        }
    }

    public function getHooks()
    {
        return [
            [
                "type" => TemplateDefinition::FRONT_OFFICE,
                "code" => "netreviews.tagmanager",
                "title" => [
                    "en_US" => "Tag manager for Verified Reviews",
                    "fr_FR" => "Tag manager pour Avis Verifies",
                ],
                "block" => false,
                "active" => true,
            ],
            [
                "type" => TemplateDefinition::FRONT_OFFICE,
                "code" => "netreviews.site.widget",
                "title" => [
                    "en_US" => "Widget Site",
                    "fr_FR" => "Widget Site",
                ],
                "block" => false,
                "active" => true,
            ],
            [
                "type" => TemplateDefinition::FRONT_OFFICE,
                "code" => "netreviews.product.iframe",
                "title" => [
                    "en_US" => "Iframe product",
                    "fr_FR" => "Iframe produit",
                ],
                "block" => false,
                "active" => true,
            ],
            [
                "type" => TemplateDefinition::FRONT_OFFICE,
                "code" => "netreviews.footer.link",
                "title" => [
                    "en_US" => "Footer link",
                    "fr_FR" => "Lien footer",
                ],
                "block" => false,
                "active" => true,
            ]
        ];
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
        $servicesConfigurator->load(self::getModuleCode().'\\', __DIR__)
            ->exclude([THELIA_MODULE_DIR . ucfirst(self::getModuleCode()). "/I18n/*"])
            ->autowire(true)
            ->autoconfigure(true);
    }
}
