<?php

namespace NetReviews\Model\Event;

use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Event\ActiveRecordEvent;
use NetReviews\Model\NetreviewsProductReview;

class NetreviewsProductReviewEvent extends ActiveRecordEvent
{
    const PRE_SAVE = 'propel.pre.save.netreviews_product_review';
    const POST_SAVE = 'propel.post.save.netreviews_product_review';
    const PRE_INSERT = 'propel.pre.insert.netreviews_product_review';
    const POST_INSERT = 'propel.post.insert.netreviews_product_review';
    const PRE_UPDATE = 'propel.pre.update.netreviews_product_review';
    const POST_UPDATE = 'propel.post.update.netreviews_product_review';
    const PRE_DELETE = 'propel.pre.delete.netreviews_product_review';
    const POST_DELETE = 'propel.post.delete.netreviews_product_review';

    /** @var NetreviewsProductReview */
    protected $model;

    /**
     * @param NetreviewsProductReview|ActiveRecordInterface $netreviewsProductReview
     */
    public function __construct(NetreviewsProductReview $netreviewsProductReview)
    {
        $this->model = $netreviewsProductReview;
    }

    /**
     * @return NetreviewsProductReview|ActiveRecordInterface
     */
    public function getModel()
    {
        return $this->model;
    }
}
