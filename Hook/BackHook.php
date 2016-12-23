<?php

namespace NetReviews\Hook;

use Thelia\Core\Event\Hook\HookRenderEvent;
use Thelia\Core\Hook\BaseHook;

class BackHook extends BaseHook
{
    public function onOrderEditBottom(HookRenderEvent $event)
    {
        $orderId = $event->getArgument('order_id');

        $event->add(
            $this->render(
                "netreviews/order-bottom.html",
                [
                    'order_id' => $orderId
                ]
            )
        );
    }
}
