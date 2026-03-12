<?php

namespace NetReviews\Command;

use NetReviews\Model\NetreviewsProductReview;
use NetReviews\Model\NetreviewsProductReviewExchangeQuery;
use NetReviews\Model\NetreviewsProductReviewQuery;
use NetReviews\NetReviews;
use NetReviews\Service\ProductReviewService;
use Propel\Runtime\Propel;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Thelia\Command\ContainerAwareCommand;
use Thelia\Log\Tlog;
use Thelia\Model\ProductQuery;

class GetProductReviewCommand extends ContainerAwareCommand
{
    public function configure()
    {
        $this
            ->setName("module:NetReviews:GetProductReview")
            ->setDescription("Get products reviews from ftp")
            ->addOption(
                'all_file',
                'a',
                InputOption::VALUE_OPTIONAL,
                'Import all the file (init)',
                false
            );
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $apiKey = NetReviews::getConfigValue('api_key');
        $idWebSite = NetReviews::getConfigValue('id_website');

        $apiUrl = "https://api.skeepers.io/v1/reviews/product";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept: application/json',
            'X-Api-Key: ' . $apiKey,
            'X-Id-Website: ' . $idWebSite
        ]);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode >= 200 && $httpCode < 300) {
            $productReviews = json_decode($response);

            foreach ($productReviews as $productReview) {
                try {
                    $netReviewsProductId = $productReview->id_product ?? $productReview->product_reference;
                    $product = ProductQuery::create()->findOneByRef($netReviewsProductId);

                    if (null === $product) {
                        continue;
                    }

                    $reviewId = $productReview->id_review ?? $productReview->id;
                    $reviewProductId = $productReview->id_review_product ?? $productReview->id;

                    if (null === $netReview = NetreviewsProductReviewQuery::create()->filterByReviewId($reviewId)->filterByProductReviewId($reviewProductId)->findOne()) {
                        $netReview = new NetreviewsProductReview();
                        $netReview
                            ->setProductReviewId($reviewProductId)
                            ->setReviewId($reviewId)
                            ->setLastname($productReview->customer->lastname ?? $productReview->lastname)
                            ->setFirstname($productReview->customer->firstname ?? $productReview->firstname)
                            ->setReviewDate($productReview->date ?? $productReview->review_date)
                            ->setMessage($productReview->comment ?? $productReview->review)
                            ->setRate($productReview->rating ?? $productReview->rate)
                            ->setOrderRef($productReview->order_reference ?? $productReview->order_ref)
                            ->setProductRef($netReviewsProductId)
                            ->setProductId($product->getId());
                        $netReview->save();
                    }

                    // Gestion des modérations/échanges si présents
                    if (property_exists($productReview, 'moderation')) {
                        foreach ($productReview->moderation as $exchange) {
                            $dateString = substr($exchange->comment_date, 0, strpos($exchange->comment_date, 'T'));

                            $exchangeData = NetreviewsProductReviewExchangeQuery::create()
                                ->filterByProductReviewId($reviewProductId)
                                ->filterByDate($dateString)
                                ->filterByWho($exchange->comment_origin)
                                ->findOneOrCreate();

                            $exchangeData->setMessage($exchange->comment);

                            $exchangeData->save();
                        }
                        $netReview->setExchange(1)->save();
                    }
                } catch (\Exception $e) {
                    NetReviews::log("One review was not imported with Skeepers API, error : ".$e->getMessage());
                }
            }
        } else {
            $output->writeln("<error>Skeepers API Error: $httpCode</error>");
        }
    }
}
