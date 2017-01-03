<?php

namespace NetReviews\Hook;

use NetReviews\Model\NetreviewsOrderQueueQuery;
use Thelia\Core\Event\Hook\HookRenderEvent;
use Thelia\Core\Hook\BaseHook;

class BackHook extends BaseHook
{
    public function onOrderEditBottom(HookRenderEvent $event)
    {
        $orderId = $event->getArgument('order_id');

        $params =  ['order_id' => $orderId];

        $netReviewsOrder = NetreviewsOrderQueueQuery::create()
            ->findOneByOrderId($orderId);

        if (null !== $netReviewsOrder) {
            $params['treated_at'] = $netReviewsOrder->getTreatedAt();
        }

        $event->add(
            $this->render(
                "netreviews/order-bottom.html",
                $params
            )
        );
    }
}
