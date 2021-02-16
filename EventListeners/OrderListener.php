<?php


namespace NetReviews\EventListeners;

use NetReviews\Model\NetreviewsOrderQueue;
use NetReviews\NetReviews;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Thelia\Core\Event\Order\OrderEvent;
use Thelia\Core\Event\TheliaEvents;

class OrderListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            TheliaEvents::ORDER_PAY => ['registerOrder', 64],
        ];
    }

    public function registerOrder(OrderEvent $event)
    {
        $statusToExport = explode(',', NetReviews::getConfigValue('status_to_export', '4'));
        if (in_array($event->getPlacedOrder()->getStatusId(), $statusToExport, true)){
            $netReviewsOrderQueue = new NetreviewsOrderQueue();
            $netReviewsOrderQueue->setOrderId($event->getPlacedOrder()->getId())
                ->setStatus(0)
                ->save();
        }
    }
}