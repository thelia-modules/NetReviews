<?php

namespace NetReviews\Model\Event;

use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Event\ActiveRecordEvent;
use NetReviews\Model\NetreviewsSiteReview;

class NetreviewsSiteReviewEvent extends ActiveRecordEvent
{
    const PRE_SAVE = 'propel.pre.save.netreviews_site_review';
    const POST_SAVE = 'propel.post.save.netreviews_site_review';
    const PRE_INSERT = 'propel.pre.insert.netreviews_site_review';
    const POST_INSERT = 'propel.post.insert.netreviews_site_review';
    const PRE_UPDATE = 'propel.pre.update.netreviews_site_review';
    const POST_UPDATE = 'propel.post.update.netreviews_site_review';
    const PRE_DELETE = 'propel.pre.delete.netreviews_site_review';
    const POST_DELETE = 'propel.post.delete.netreviews_site_review';

    /** @var NetreviewsSiteReview */
    protected $model;

    /**
     * @param NetreviewsSiteReview|ActiveRecordInterface $netreviewsSiteReview
     */
    public function __construct(NetreviewsSiteReview $netreviewsSiteReview)
    {
        $this->model = $netreviewsSiteReview;
    }

    /**
     * @return NetreviewsSiteReview|ActiveRecordInterface
     */
    public function getModel()
    {
        return $this->model;
    }
}
