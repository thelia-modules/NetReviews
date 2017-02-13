<?php

namespace NetReviews\Service;

use NetReviews\Model\NetreviewsProductReviewExchangeQuery;
use NetReviews\Model\NetreviewsProductReviewQuery;
use NetReviews\NetReviews;
use Propel\Runtime\Connection\SqlConnectionInterface;
use Propel\Runtime\Propel;
use Symfony\Component\Finder\Finder;

class ProductReviewService
{
    public function getFile($filename = null)
    {
        $ftpHost = NetReviews::getConfigValue('ftp_server');
        $ftpUsername = NetReviews::getConfigValue('ftp_username');
        $ftpPassword = NetReviews::getConfigValue('ftp_password');
        $ftpPort = NetReviews::getConfigValue('ftp_port', 21);
        $ftpDirectory = NetReviews::getConfigValue('ftp_directory', '/');

        $finder = new Finder();
        $finder->files()->in("ftp://$ftpUsername:$ftpPassword@$ftpHost:$ftpPort$ftpDirectory");

        if ($filename) {
            $finder->name($filename);
        }

        return $finder;
    }

    public function createOrUpdateReview($review)
    {
        $reviewData = NetreviewsProductReviewQuery::create()
            ->filterByProductReviewId($review['product_review_id'])
            ->findOneOrCreate();

        $reviewData->setReviewId($review['review_id'])
            ->setEmail($review['email'])
            ->setLastname($review['lastname'])
            ->setFirstname($review['firstname'])
            ->setReviewDate($review['review_date'])
            ->setMessage($review['review'])
            ->setRate($review['rate'])
            ->setOrderRef($review['order_ref'])
            ->setProductRef($review['product_ref']);

        $reviewData->save();

        if (isset($review['moderation'])) {
            $this->addExchanges($review['product_review_id'], $review['moderation']['exchange']);
            $reviewData->setExchange(1);
            $reviewData->save();
        }
    }

    public function deleteReview($review)
    {
        $reviewData = NetreviewsProductReviewQuery::create()
            ->findOneByReviewId($review['review_id']);

        if (null !== $reviewData) {
            $reviewData->delete();
        }
    }

    public function addExchanges($reviewId, $exchanges)
    {
        foreach ($exchanges as $exchange) {
            $exchangeData = NetreviewsProductReviewExchangeQuery::create()
                ->filterByProductReviewId($reviewId)
                ->filterByDate($exchange['date'])
                ->filterByWho($exchange['author'])
                ->filterByMessage($exchange['comment'])
                ->findOneOrCreate();

            $exchangeData->save();
        }
    }

    public function getProductReviews($productId)
    {
        /** @var SqlConnectionInterface $con */
        $con = Propel::getConnection();

        $query = "SELECT npr.*, npre.date AS exchange_date, npre.who AS exchange_who, npre.message AS exchange_message,
                (SELECT AVG(nprr.rate) FROM netreviews_product_review nprr WHERE nprr.product_ref = npr.product_ref) AS product_rate
                FROM netreviews_product_review npr 
                LEFT JOIN product p ON (npr.product_ref = p.ref)
                LEFT JOIN netreviews_product_review_exchange npre ON (npr.product_review_id = npre.product_review_id)
                WHERE p.id = $productId";

        $stmt = $con->prepare($query);
        $stmt->execute();

        $productReviews = [];
        $exchanges = [];

        while ($result = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $productReviews['rate'] = $result['product_rate'];
            $productReviews['reviews'][$result['product_review_id']] = [
                'email' => $result['email'],
                'lastname' => $result['lastname'],
                'firstname' => $result['firstname'],
                'review_date' => $result['review_date'],
                'message' => $result['message'],
                'rate' => $result['rate'],
                'exchange' => $result['exchange'],
            ];

            $exchanges[$result['product_review_id']][] = [
                'date' => $result['exchange_date'],
                'who' => $result['exchange_who'],
                'message' => $result['exchange_message']
            ];

            $productReviews['reviews'][$result['product_review_id']]['exchanges'] = $exchanges[$result['product_review_id']];
        }


        return $productReviews;
    }

    /**
     * @param string $xml
     * @return array
     */
    public function xmlToArray($xml)
    {
        $result = "";
        function normalizeSimpleXML($obj, &$result)
        {
            $data = $obj;
            if (is_object($data)) {
                $data = get_object_vars($data);
            }
            if (is_array($data)) {
                foreach ($data as $key => $value) {
                    $res = null;
                    normalizeSimpleXML($value, $res);
                    if (($key == '@attributes') && ($key)) {
                        $result = $res;
                    } else {
                        $result[$key] = $res;
                    }
                }
            } else {
                $result = $data;
            }
        }
        normalizeSimpleXML(simplexml_load_string($xml, null, LIBXML_NOCDATA), $result);
        return $result;
    }
}
