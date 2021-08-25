<?php

namespace NetReviews\Hook;

use NetReviews\NetReviews;
use NetReviews\Object\NetReviewsProduct;
use NetReviews\Service\OrderService;
use Propel\Runtime\Connection\ConnectionWrapper;
use Propel\Runtime\Propel;
use Symfony\Component\HttpFoundation\RequestStack;
use Thelia\Core\Event\Hook\HookRenderBlockEvent;
use Thelia\Core\Event\Hook\HookRenderEvent;
use Thelia\Core\Event\Image\ImageEvent;
use Thelia\Core\Event\TheliaEvents;
use Thelia\Core\Hook\BaseHook;
use Thelia\Model\ConfigQuery;
use Thelia\Model\ProductImage;
use Thelia\Model\ProductQuery;

class FrontHook extends BaseHook
{
    /** @var  OrderService */
    protected $netreviewsOrderService;

    public function __construct(OrderService $netreviewsOrderService)
    {
        $this->netreviewsOrderService = $netreviewsOrderService;
    }

    public function displayTag(HookRenderEvent $event)
    {
        $idWebSite = NetReviews::getConfigValue('id_website');
        $secret = NetReviews::getConfigValue('secret_token');
        $order_id = $event->getArgument('order_id');

        $netreviewsOrder = $this->netreviewsOrderService->getNetreviewsOrder($order_id);

        $token = sha1($idWebSite.$secret.$netreviewsOrder->getRef());

        $products = [];

        /** @var NetReviewsProduct $product */
        foreach ($netreviewsOrder->getProducts() as $product) {
            $products[] = [
                'name_product' => $product->getName(),
                'id_product' => $product->getId(),
                'url_product' => $product->getUrl(),
                'url_image_product' => $product->getImageUrl()
            ];
        }

        $netreviews = [
            "idWebsite" => $idWebSite,
            "orderRef" => $netreviewsOrder->getRef(),
            "firstname" => $netreviewsOrder->getFirstname(),
            "lastname" => $netreviewsOrder->getLastname(),
            "email" => $netreviewsOrder->getEmail(),
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

    public function displayProductTabReview(HookRenderBlockEvent $event)
    {
        $reviewMode = NetReviews::getConfigValue('product_review_mode');
        $content = null;

        $productId = $event->getArgument('product');
        $product = ProductQuery::create()
            ->findPk($productId);

        if (null !== $product) {
            if ($reviewMode === 'iframe') {
                $code = NetReviews::getConfigValue('product_iframe_code');
                if ($code != null) {
                    $content = $this->render(
                        "netreviews/product-iframe.html",
                        [
                            "product_iframe_code" => $code,
                            "product_ref" => $product->getRef()
                        ]
                    );
                }
            } elseif ($reviewMode === 'custom') {
                $content = $this->render(
                    "netreviews/product-review.html",
                    [
                        'product_id' => $productId
                    ]
                );
            }

            if (null != $content) {
                $event->add(
                    [
                        'id' => 'netreviews_tab',
                        'class' => '',
                        'title' => $this->trans('Net Reviews', [], NetReviews::DOMAIN_NAME),
                        'content' => $content
                    ]
                );
            }
        }
    }

    /**
     * @param string $imageFile
     * @return ImageEvent
     */
    protected function createProductImageEvent($imageFile)
    {
        $imageEvent = new ImageEvent();
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
