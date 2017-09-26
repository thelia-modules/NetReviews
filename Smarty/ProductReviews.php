<?php

namespace NetReviews\Smarty;

use NetReviews\NetReviews;
use NetReviews\Service\ProductReviewService;
use TheliaSmarty\Template\AbstractSmartyPlugin;
use TheliaSmarty\Template\SmartyPluginDescriptor;

class ProductReviews extends AbstractSmartyPlugin
{
    /** @var ProductReviewService  */
    protected $productReviewService;

    public function __construct(ProductReviewService $productReviewService)
    {
        $this->productReviewService = $productReviewService;
    }

    public function getPluginDescriptors()
    {
        return [
            new SmartyPluginDescriptor('function', 'product_reviews', $this, 'getProductReviews')
        ];
    }

    /**
     * @param array $params
     * @param \Smarty_Internal_Template $smarty
     */
    public function getProductReviews($params, $smarty)
    {
        if (isset($params['product_id'])) {
            $productId = $params['product_id'];
            $order = $params['order'];

            $getExchanges = NetReviews::getConfigValue('display_product_review_exchanges', 'true') === 'true'? true: false;;

            $reviews = $this->productReviewService->getProductReviews($productId, $getExchanges, $order);

            $smarty->assign('product_reviews', $reviews);
        }
    }
}
