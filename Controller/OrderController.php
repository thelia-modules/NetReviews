<?php

namespace NetReviews\Controller;

use NetReviews\Service\OrderService;
use Thelia\Controller\Admin\BaseAdminController;

class OrderController extends BaseAdminController
{
    public function sendAction($orderId)
    {
        /** @var OrderService $orderService */
        $orderService = $this->container->get('netreviews.order.service');

        $orderService->sendOrderToNetReviews($orderId);
        
    }

}