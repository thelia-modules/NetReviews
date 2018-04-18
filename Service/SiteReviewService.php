<?php

namespace NetReviews\Service;

use NetReviews\Model\Base\NetreviewsSiteReviewQuery;
use NetReviews\Model\NetreviewsSiteReview;
use NetReviews\NetReviews;
use Propel\Runtime\Exception\PropelException;

class SiteReviewService
{
    /**
     * @param $row
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function addRow($row)
    {
        $review = NetreviewsSiteReviewQuery::create()
            ->findOneByReviewId($row->id_review);

        if (null !== $review) {
            return;
        }

        $review = new NetreviewsSiteReview();

        try {
            $review
                ->setReviewId($row->id_review)
                ->setLastname($row->lastname)
                ->setFirstname($row->firstname)
                ->setReview($row->review)
                ->setReviewDate($row->review_date)
                ->setRate($row->rate)
                ->setOrderRef($row->order_ref)
                ->setOrderDate($row->order_date)
                ->save();

        } catch (PropelException $e) {
            NetReviews::log($e);
        }
    }

    public function delRow($row)
    {
        $review = NetreviewsSiteReviewQuery::create()
            ->findOneByReviewId($row->id_review);

        if (null !== $review) {
            $review->delete();
        }
    }

    public function updateRow($row)
    {
        $review = NetreviewsSiteReviewQuery::create()
            ->findOneByReviewId($row->id_review);

        if (null === $review) {
            return;
        }

        try {
            $review
                ->setReviewId($row->id_review)
                ->setLastname($row->lastname)
                ->setFirstname($row->firstname)
                ->setReview($row->review)
                ->setReviewDate($row->review_date)
                ->setRate($row->rate)
                ->setOrderRef($row->order_ref)
                ->setOrderDate($row->order_date)
                ->save();

        } catch (PropelException $e) {
            NetReviews::log($e);
        }
    }

    public function calculSiteRate()
    {
        $reviewsRate = NetreviewsSiteReviewQuery::create()->find()->getData();

        $averageRate = 0;
        $countRate = count($reviewsRate);

        /** @var NetreviewsSiteReviewQuery $reviewRate */
        foreach ($reviewsRate as $reviewRate){
            $averageRate += $reviewRate->getRate();
        }

        $averageRate = round($averageRate / $countRate,2);

        return round($averageRate = $averageRate * 2, 1);
    }

    public function getRows($limit = null)
    {
        $reviews = NetreviewsSiteReviewQuery::create();
        if($limit){
           $reviews->setLimit($limit);
        }
        return $reviews->find();
    }

    public function readRate()
    {
        $fileRateJson = __DIR__ . "/../Command/rate.json";

        if ($handle = file_get_contents($fileRateJson)) {
            $jsonRate = json_decode($handle);
            return $jsonRate->rate_site;
        } else {
            return false;
        }
    }
}