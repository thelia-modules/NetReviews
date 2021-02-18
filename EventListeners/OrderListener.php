<?php

namespace NetReviews\EventListeners;

use NetReviews\Model\NetreviewsOrderQueue;
use NetReviews\Model\NetreviewsOrderQueueQuery;
use NetReviews\NetReviews;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Thelia\Core\Event\Order\OrderEvent;
use Thelia\Core\Event\OrderStatus\OrderStatusEvent;
use Thelia\Core\Event\TheliaEvents;
use Thelia\Model\OrderStatus;

class OrderListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            TheliaEvents::ORDER_PAY => ['registerOrder', 64],
            TheliaEvents::ORDER_UPDATE_STATUS => ['checkOrderInQueue', 64],
        ];
    }

    /**
     * @param OrderEvent $event
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function registerOrder(OrderEvent $event)
    {
        $statusToExport = explode(',', NetReviews::getConfigValue('status_to_export', '4'));
        if (in_array($event->getPlacedOrder()->getStatusId(), $statusToExport, false)){
            $netReviewsOrderQueue = new NetreviewsOrderQueue();
            $netReviewsOrderQueue->setOrderId($event->getPlacedOrder()->getId())
                ->setStatus(0)
                ->save();
        }
    }

    /**
     * @param OrderEvent $event
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function checkOrderInQueue(OrderEvent $event)
    {
        $statusToExport = explode(',', NetReviews::getConfigValue('status_to_export', '4'));

        $newStatus = $event->getOrder()->getStatusId();
        $orderId = $event->getOrder()->getId();

        $netReviewsOrderQueue = NetreviewsOrderQueueQuery::create()
            ->filterByOrderId($orderId)
            ->findOne();

        if (null !== $netReviewsOrderQueue){
            if (!in_array($newStatus, $statusToExport, false) && (int)$netReviewsOrderQueue->getStatus() === 0){
                $netReviewsOrderQueue->delete();
            }
        } else if (in_array($newStatus, $statusToExport, false)){
            $netReviewsOrderQueue = new NetreviewsOrderQueue();
            $netReviewsOrderQueue->setOrderId($orderId)
                ->setStatus(0)
                ->save();
        }
    }
}