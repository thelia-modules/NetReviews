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

namespace NetReviews\Twig;

use NetReviews\Service\NetReviewsFrontRenderer;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Exposes the NetReviews front-office rendering to the Flexy theme (Thelia 3 has no front
 * Smarty hooks). Thin Twig glue: all markup/data comes from NetReviewsFrontRenderer.
 *
 * Call these functions in the theme where the Thelia 2 hooks used to inject content:
 *   - {{ netreviews_tag_manager() }}          on every page (renders only on order confirmation)
 *   - {{ netreviews_site_widget() }} / {{ netreviews_footer_link() }}  in the footer
 *   - {{ netreviews_product_iframe(product.ref) }}  on the product page (iframe mode)
 *   - {% for review in netreviews_product_reviews(product.id) %} …    (custom mode)
 */
final class NetReviewsExtension extends AbstractExtension
{
    public function __construct(
        private readonly NetReviewsFrontRenderer $renderer,
    ) {
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('netreviews_tag_manager', $this->renderer->tagManager(...), ['is_safe' => ['html']]),
            new TwigFunction('netreviews_site_widget', $this->renderer->siteWidget(...), ['is_safe' => ['html']]),
            new TwigFunction('netreviews_product_iframe', $this->renderer->productIframe(...), ['is_safe' => ['html']]),
            new TwigFunction('netreviews_footer_link', $this->renderer->footerLink(...), ['is_safe' => ['html']]),
            new TwigFunction('netreviews_product_review_mode', $this->renderer->productReviewMode(...)),
            new TwigFunction('netreviews_product_reviews', $this->renderer->productReviews(...)),
            new TwigFunction('netreviews_site_reviews', $this->renderer->siteReviews(...)),
            new TwigFunction('netreviews_site_rate', $this->renderer->siteRate(...)),
        ];
    }
}
