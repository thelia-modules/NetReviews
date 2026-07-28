<?php

namespace NetReviews\Model\Event;

use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Event\ActiveRecordEvent;
use NetReviews\Model\NetreviewsProductReviewExchange;

class NetreviewsProductReviewExchangeEvent extends ActiveRecordEvent
{
    const PRE_SAVE = 'propel.pre.save.netreviews_product_review_exchange';
    const POST_SAVE = 'propel.post.save.netreviews_product_review_exchange';
    const PRE_INSERT = 'propel.pre.insert.netreviews_product_review_exchange';
    const POST_INSERT = 'propel.post.insert.netreviews_product_review_exchange';
    const PRE_UPDATE = 'propel.pre.update.netreviews_product_review_exchange';
    const POST_UPDATE = 'propel.post.update.netreviews_product_review_exchange';
    const PRE_DELETE = 'propel.pre.delete.netreviews_product_review_exchange';
    const POST_DELETE = 'propel.post.delete.netreviews_product_review_exchange';

    /** @var NetreviewsProductReviewExchange */
    protected $model;

    /**
     * @param NetreviewsProductReviewExchange|ActiveRecordInterface $netreviewsProductReviewExchange
     */
    public function __construct(NetreviewsProductReviewExchange $netreviewsProductReviewExchange)
    {
        $this->model = $netreviewsProductReviewExchange;
    }

    /**
     * @return NetreviewsProductReviewExchange|ActiveRecordInterface
     */
    public function getModel()
    {
        return $this->model;
    }
}
