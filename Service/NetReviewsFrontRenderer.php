<?php

declare(strict_types=1);

/*************************************************************************************/
/*      This file is part of the Thelia package.                                     */
/*                                                                                   */
/*      Copyright (c) OpenStudio                                                     */
/*      email : dev@thelia.net                                                       */
/*      web : http://www.thelia.net                                                  */
/*                                                                                   */
/*      For the full copyright and license information, please view the LICENSE.txt  */
/*************************************************************************************/

namespace NetReviews\Service;

use NetReviews\NetReviews;
use NetReviews\Object\NetReviewsProduct;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Builds the NetReviews front-office markup and data for the Thelia 3 (Flexy) theme.
 *
 * Kept separate from NetReviews\Twig\NetReviewsExtension so the extension stays a thin
 * Twig integration layer (single responsibility), mirroring the GoogleTagManager module
 * (GtmTagRenderer + GoogleTagManagerExtension).
 */
final readonly class NetReviewsFrontRenderer
{
    public function __construct(
        private OrderService $orderService,
        private ProductReviewService $productReviewService,
        private SiteReviewService $siteReviewService,
        private RequestStack $requestStack,
    ) {
    }

    /**
     * dataLayer push for the order confirmation page. When no id is given, self-detects the
     * 'order-placed' view and its order_id from the request (mirrors GoogleTagManager).
     */
    public function tagManager(int|string|null $orderId = null): string
    {
        if (null === $orderId) {
            $request = $this->requestStack->getCurrentRequest();
            if (null === $request) {
                return '';
            }
            $view = $request->attributes->get('_view', $request->query->get('_view'));
            if ('order-placed' !== $view) {
                return '';
            }
            $orderId = $request->attributes->get('order_id', $request->query->get('order_id'));
        }

        $idWebSite = (string) NetReviews::getConfigValue('id_website');
        if ('' === $idWebSite || null === $orderId) {
            return '';
        }

        $secret = (string) NetReviews::getConfigValue('secret_token');
        $order = $this->orderService->getNetreviewsOrder((int) $orderId);

        $products = [];
        /** @var NetReviewsProduct $product */
        foreach ($order->getProducts() as $product) {
            $products[] = [
                'name_product' => $product->getName(),
                'id_product' => $product->getId(),
                'url_product' => $product->getUrl(),
                'url_image_product' => $product->getImageUrl(),
            ];
        }

        $netreviews = json_encode([
            'idWebsite' => $idWebSite,
            'orderRef' => $order->getRef(),
            'firstname' => $order->getFirstname(),
            'lastname' => $order->getLastname(),
            'email' => $order->getEmail(),
            'products' => $products,
            'token' => sha1($idWebSite.$secret.$order->getRef()),
        ], JSON_THROW_ON_ERROR | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);

        return <<<HTML
<script type="text/javascript">
    window.dataLayer = window.dataLayer || [];
    var netreviews = {$netreviews};
    dataLayer.push({ 'netreviews': netreviews });
</script>
HTML;
    }

    public function siteWidget(): string
    {
        $code = (string) NetReviews::getConfigValue('site_widget_code');
        if ('' === $code) {
            return '';
        }

        return '<div id="netreviews_site_widget">'.$code.'</div>';
    }

    public function productIframe(?string $productRef): string
    {
        $code = (string) NetReviews::getConfigValue('product_iframe_code');
        if ('' === $code) {
            return '';
        }

        $ref = htmlspecialchars((string) $productRef, ENT_QUOTES);

        return <<<HTML
<div id="product_reviews">
    <div class="netreviews"></div>
    <form action="" id="netreviews_form">
        <input type="hidden" name="product_ref" value="{$ref}">
    </form>
    {$code}
</div>
HTML;
    }

    public function footerLink(): string
    {
        $link = (string) NetReviews::getConfigValue('footer_link');
        if ('' === $link) {
            return '';
        }

        $title = (string) NetReviews::getConfigValue('footer_link_title');

        return '<a href="'.htmlspecialchars($link, ENT_QUOTES).'">'.htmlspecialchars($title, ENT_QUOTES).'</a>';
    }

    /**
     * 'iframe' or 'custom' — lets the theme decide how to render product reviews.
     */
    public function productReviewMode(): string
    {
        return (string) NetReviews::getConfigValue('product_review_mode');
    }

    /**
     * Product reviews imported in database (custom mode):
     * ['rate' => ..., 'count' => ..., 'reviews' => [...]].
     *
     * @return array<string, mixed>
     */
    public function productReviews(int|string $productId, string $order = 'review_date'): array
    {
        $withExchanges = 'true' === NetReviews::getConfigValue('display_product_review_exchanges', 'true');

        return $this->productReviewService->getProductReviews((int) $productId, $withExchanges, $order) ?? [];
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public function siteReviews(?int $limit = null): array
    {
        return $this->siteReviewService->getRows($limit)->getData() ?? [];
    }

    public function siteRate(): mixed
    {
        return $this->siteReviewService->readRate();
    }
}
