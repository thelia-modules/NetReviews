<?php

declare(strict_types=1);

namespace NetReviews\Hook;

use NetReviews\Model\NetreviewsOrderQueueQuery;
use NetReviews\NetReviews;
use Thelia\Core\Event\Hook\HookRenderEvent;
use Thelia\Core\Hook\BaseHook;

class BackHook extends BaseHook
{
    public function onModuleConfigure(HookRenderEvent $event)
    {
        if (NetReviews::isThelia3()) {
            return; // Thelia 3: handled by NetReviews\Hook\Back\ConfigurationHook (Twig).
        }

        $event->add($this->render(
            "netreviews/configuration.html",
            [
                "id_web_site" => NetReviews::getConfigValue('id_web_site'),
                "token" => NetReviews::getConfigValue('token')
            ]
        ));
    }

    public function onModuleConfigureJs(HookRenderEvent $event)
    {
        if (NetReviews::isThelia3()) {
            return; // Thelia 3: handled by NetReviews\Hook\Back\ConfigurationHook (Twig).
        }

        $event->add($this->render(
            "netreviews/configuration-js.html",
        ));
    }

    public function onOrderEditBottom(HookRenderEvent $event)
    {
        if (NetReviews::isThelia3()) {
            return; // Thelia 3: handled by NetReviews\Hook\Back\OrderEditHook (Twig).
        }

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
