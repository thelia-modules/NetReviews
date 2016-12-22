<?php

namespace NetReviews\Hook;

use NetReviews\NetReviews;
use Propel\Runtime\Connection\ConnectionWrapper;
use Propel\Runtime\Propel;
use Thelia\Core\Event\Hook\HookRenderBlockEvent;
use Thelia\Core\Event\Hook\HookRenderEvent;
use Thelia\Core\Event\Image\ImageEvent;
use Thelia\Core\Event\TheliaEvents;
use Thelia\Core\Hook\BaseHook;
use Thelia\Model\ConfigQuery;
use Thelia\Model\ProductImage;

class FrontHook extends BaseHook
{
    public function displayTag(HookRenderEvent $event)
    {
        $idWebSite = NetReviews::getConfigValue('id_website');
        $secret = NetReviews::getConfigValue('secret_token');
        $order_id = $event->getArgument('order_id');

        /** @var ConnectionWrapper $con */
        $con = Propel::getConnection();

        $orderProductSql = "SELECT o.ref, cu.firstname, cu.lastname, cu.email, op.product_ref, op.title, ru.url, pi.file
                            FROM order_product op 
                            LEFT JOIN `order` o ON (op.order_id = o.id)
                            LEFT JOIN `customer` cu ON (o.customer_id = cu.id)
                            LEFT JOIN `product` p ON (p.ref = op.product_ref)
                            LEFT JOIN `rewriting_url` ru ON (p.id = ru.view_id)
                            LEFT JOIN `product_image` pi ON (p.id = pi.product_id)
                            WHERE o.id = $order_id
                            AND ru.view = 'product'
                            AND ru.redirected IS NULL
                            AND pi.position = 1
                            ";

        $stmt = $con->prepare($orderProductSql);
        $stmt->execute();
        $results = $stmt->fetchAll();

        $orderRef = $results[0]['ref'];
        $token = sha1($idWebSite.$secret.$orderRef);
        $firstname = $results[0]['firstname'];
        $lastname = $results[0]['lastname'];
        $email = $results[0]['email'];

        $baseUrl = ConfigQuery::read('url_site');

        $products = [];

        foreach ($results as $orderProduct) {
            $imageEvent = $this->createProductImageEvent($orderProduct['file']);
            $event->getDispatcher()->dispatch(TheliaEvents::IMAGE_PROCESS, $imageEvent);
            $imagePath = $imageEvent->getFileUrl();

            $products[] = [
                'name_product' => $orderProduct['title'],
                'id_product' => $orderProduct['product_ref'],
                'url_product' => $baseUrl."/".$orderProduct['url'],
                'url_image_product' => $imagePath
            ];
        }

        $netreviews = [
            "idWebsite" => $idWebSite,
            "orderRef" => $orderRef,
            "firstname" => $firstname,
            "lastname" => $lastname,
            "email" => $email,
            "products" => $products,
            "token" => $token,
        ];

        $event->add(
            $this->render(
                "netreviews/tag-manager.html",
                ["netreviews" => json_encode($netreviews)]
            )
        );
    }

    public function displaySiteWidget(HookRenderEvent $event)
    {
        $code = NetReviews::getConfigValue('site_widget_code');

        $event->add(
            $this->render(
                "netreviews/site-widget.html",
                ["site_widget_code" => $code]
            )
        );
    }

    public function displayProductIframe(HookRenderEvent $event)
    {
        $code = NetReviews::getConfigValue('product_iframe_code');

        $product_ref = $event->getArgument('product_ref');

        $event->add(
            $this->render(
                "netreviews/product-iframe.html",
                [
                    "product_iframe_code" => $code,
                    "product_ref" => $product_ref
                ]
            )
        );
    }

    public function displayFooterLink(HookRenderEvent $event)
    {
        $linkTitle = NetReviews::getConfigValue('footer_link_title');
        $link = NetReviews::getConfigValue('footer_link');

        $event->add(
            $this->render(
                "netreviews/footer-link.html",
                [
                    "link_title" => $linkTitle,
                    "link" => $link
                ]
            )
        );
    }

    public function displayProductTabIframe(HookRenderBlockEvent $event)
    {
        $code = NetReviews::getConfigValue('product_iframe_code');
        $product_ref = $event->getArgument('product_ref');
        $content = $this->render(
            "netreviews/product-iframe.html",
            [
                "product_iframe_code" => $code,
                "product_ref" => $product_ref
            ]
        );

        $event->add(
            [
                'id' => 'netreviews_tab',
                'class' => '',
                'title' => $this->trans('Net Reviews', [], NetReviews::DOMAIN_NAME),
                'content' => $content
            ]
        );

    }

    /**
     * @param string $imageFile
     * @return ImageEvent
     */
    protected function createProductImageEvent($imageFile)
    {
        $imageEvent = new ImageEvent($this->request);
        $baseSourceFilePath = ConfigQuery::read('images_library_path');
        if ($baseSourceFilePath === null) {
            $baseSourceFilePath = THELIA_LOCAL_DIR . 'media' . DS . 'images';
        } else {
            $baseSourceFilePath = THELIA_ROOT . $baseSourceFilePath;
        }
        // Put source image file path
        $sourceFilePath = sprintf(
            '%s/%s/%s',
            $baseSourceFilePath,
            'product',
            $imageFile
        );
        $imageEvent->setSourceFilepath($sourceFilePath);
        $imageEvent->setCacheSubdirectory('product');
        return $imageEvent;
    }
}
