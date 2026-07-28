<?php

namespace NetReviews\Model\Event;

use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Event\ActiveRecordEvent;
use NetReviews\Model\NetreviewsOrderQueue;

class NetreviewsOrderQueueEvent extends ActiveRecordEvent
{
    const PRE_SAVE = 'propel.pre.save.netreviews_order_queue';
    const POST_SAVE = 'propel.post.save.netreviews_order_queue';
    const PRE_INSERT = 'propel.pre.insert.netreviews_order_queue';
    const POST_INSERT = 'propel.post.insert.netreviews_order_queue';
    const PRE_UPDATE = 'propel.pre.update.netreviews_order_queue';
    const POST_UPDATE = 'propel.post.update.netreviews_order_queue';
    const PRE_DELETE = 'propel.pre.delete.netreviews_order_queue';
    const POST_DELETE = 'propel.post.delete.netreviews_order_queue';

    /** @var NetreviewsOrderQueue */
    protected $model;

    /**
     * @param NetreviewsOrderQueue|ActiveRecordInterface $netreviewsOrderQueue
     */
    public function __construct(NetreviewsOrderQueue $netreviewsOrderQueue)
    {
        $this->model = $netreviewsOrderQueue;
    }

    /**
     * @return NetreviewsOrderQueue|ActiveRecordInterface
     */
    public function getModel()
    {
        return $this->model;
    }
}
