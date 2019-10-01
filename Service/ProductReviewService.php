<?php

namespace NetReviews\Service;

use NetReviews\Model\NetreviewsProductReviewExchangeQuery;
use NetReviews\Model\NetreviewsProductReviewQuery;
use NetReviews\NetReviews;
use Propel\Runtime\Connection\SqlConnectionInterface;
use Propel\Runtime\Propel;
use Symfony\Component\Finder\Finder;
use Thelia\Model\ProductQuery;

class ProductReviewService
{
    public function getFile($filename = null)
    {
        $getReviewMode = NetReviews::getConfigValue('get_review_mode');

        if (null == $getReviewMode) {
            throw new \Exception('You need to choose a get review mode before import');
        }

        $finder = new Finder();

        if ($getReviewMode == 'ftp') {
            $ftpHost = NetReviews::getConfigValue('ftp_server');
            $ftpUsername = NetReviews::getConfigValue('ftp_username');
            $ftpPassword = NetReviews::getConfigValue('ftp_password');
            $ftpPort = NetReviews::getConfigValue('ftp_port', 21);
            $ftpDirectory = NetReviews::getConfigValue('ftp_directory', '/');
            $finder->files()->in("ftp://$ftpUsername:$ftpPassword@$ftpHost:$ftpPort$ftpDirectory")->depth('== 0');
        } elseif ($getReviewMode == 'local') {
            $finder->files()->in(THELIA_ROOT.NetReviews::getConfigValue('review_local_path'))->depth('== 0');
        }

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

        $product = ProductQuery::create()
            ->findOneByRef($review['product_ref']);

        if ($product !== null) {
            $reviewData->setReviewId($review['review_id'])
                ->setEmail($review['email'])
                ->setLastname($review['lastname'])
                ->setFirstname($review['firstname'])
                ->setReviewDate($review['review_date'])
                ->setMessage($review['review'])
                ->setRate($review['rate'])
                ->setOrderRef($review['order_ref'])
                ->setProductRef($review['product_ref'])
                ->setProductId($product->getId());
            $reviewData->save();

            if (isset($review['moderation'])) {
                $this->addExchanges($review['product_review_id'], $review['moderation']['exchange']);
                $reviewData->setExchange(1);
                $reviewData->save();
            }
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

    public function addExchanges($reviewId, $exchangeArray)
    {
        if (isset($exchangeArray['date'])) {
            $this->addExchange($reviewId, $exchangeArray);
        } else {
            foreach ($exchangeArray as $exchange) {
                $this->addExchange($reviewId, $exchange);
            }
        }
    }

    protected function addExchange($reviewId, $exchange)
    {
        $exchangeData = NetreviewsProductReviewExchangeQuery::create()
            ->filterByProductReviewId($reviewId)
            ->filterByDate($exchange['date'])
            ->filterByWho($exchange['author'])
            ->findOneOrCreate();

        $exchangeData->setMessage($exchange['comment']);

        $exchangeData->save();
    }

    public function getProductReviews($productId, $withExchanges = true, $order = 'review_date')
    {
        /** @var SqlConnectionInterface $con */
        $con = Propel::getConnection();

        $query = "SELECT npr.*, npre.date AS exchange_date, npre.who AS exchange_who, npre.message AS exchange_message,
                (SELECT AVG(nprr.rate) FROM netreviews_product_review nprr WHERE nprr.product_ref = npr.product_ref) AS product_rate
                FROM netreviews_product_review npr 
                LEFT JOIN netreviews_product_review_exchange npre ON (npr.product_review_id = npre.product_review_id)
                WHERE npr.product_id = $productId ";

        switch ($order) {
            case 'review_date.asc':
                $query .= " ORDER BY npr.review_date ASC";
                break;
            case 'review_date.desc':
                $query .= " ORDER BY npr.review_date DESC";
                break;
            case 'rate.asc':
                $query .= " ORDER BY npr.rate ASC";
                break;
            case 'rate.desc':
                $query .= " ORDER BY npr.rate DESC";
                break;
            case 'review_date.desc':
            default:
                $query .= " ORDER BY npr.review_date DESC";
                break;
        }

        $stmt = $con->prepare($query);
        $stmt->execute();

        $productReviews = ['reviews' => []];
        $exchanges = [];

        while ($result = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $productReviews['rate'] = $result['product_rate'];
            $productReviews['reviews'][$result['product_review_id']] = [
                'email' => $result['email'],
                'lastname' => $result['lastname'],
                'firstname' => $result['firstname'],
                'date' => $result['review_date'],
                'message' => $result['message'],
                'rate' => $result['rate'],
                'exchange' => $result['exchange'],
            ];

            if (true == $withExchanges) {
                $exchanges[$result['product_review_id']][] = [
                    'date' => $result['exchange_date'],
                    'who' => $result['exchange_who'],
                    'message' => $result['exchange_message']
                ];

                $productReviews['reviews'][$result['product_review_id']]['exchanges'] = $exchanges[$result['product_review_id']];
            }
        }

        $count = count($productReviews['reviews']);

        $productReviews['count'] = $count;

        return $productReviews;
    }

    /**
     * @param string $xml
     * @return array
     */
    public function xmlToArray($xml)
    {
        $result = [];
        $this->normalizeSimpleXML(simplexml_load_string($xml, null, LIBXML_NOCDATA), $result);
        return $result;
    }

    protected function normalizeSimpleXML($obj, &$result)
    {
        $data = $obj;
        if (is_object($data)) {
            $data = get_object_vars($data);
        }
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $res = null;
                $this->normalizeSimpleXML($value, $res);
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
}
