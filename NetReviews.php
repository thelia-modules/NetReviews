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
use Propel\Runtime\Connection\ConnectionInterface;
use Thelia\Core\Template\TemplateDefinition;
use Thelia\Install\Database;
use Thelia\Module\BaseModule;

class NetReviews extends BaseModule
{
    /** @var string */
    const DOMAIN_NAME = 'netreviews';

    const DEBUG_MODE = 1;

    public function postActivation(ConnectionInterface $con = null)
    {
        try {
            NetreviewsOrderQueueQuery::create()
                ->find();
        } catch (\Exception $exception) {
            $database = new Database($con);
            $database->insertSql(null, [__DIR__ . "/Config/sql/netreviews_order_queue.sql"]);
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
}
