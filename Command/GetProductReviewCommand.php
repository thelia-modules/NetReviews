<?php

namespace NetReviews\Command;

use NetReviews\Model\NetreviewsProductReview;
use NetReviews\Model\NetreviewsProductReviewQuery;
use NetReviews\NetReviews;
use NetReviews\Service\ProductReviewService;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Thelia\Command\ContainerAwareCommand;
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
        $getReviewMode = NetReviews::getConfigValue('get_review_mode');

        switch ($getReviewMode) {
            case 'api' :
                $this->executeApiImport($input, $output);
                break;
            default:
                $this->executeFileTransferImport($input, $output);
                break;
        }
    }

    protected function executeFileTransferImport(InputInterface $input, OutputInterface $output)
    {
        /** @var ProductReviewService $productReviewService */
        $productReviewService = $this->getContainer()->get('netreviews.product_review.service');
        $idWebsite = NetReviews::getConfigValue('id_website');

        $lastImport = NetReviews::getConfigValue(NetReviews::LAST_IMPORT_KEY, (new \DateTime())->getTimestamp());
        $startDate = \DateTime::createFromFormat('U', $lastImport);
        $endDate = (new \DateTime());

        $interval = \DateInterval::createFromDateString('1 day');
        $period = new \DatePeriod($startDate, $interval, $endDate);

        /** @var \DateTime $date */
        foreach ($period as $date) {
            $year = $date->format('Y');
            $month = $date->format('m');
            $day = $date->format('d');
            $fileNameFormat = $idWebsite."_".$year.$month.$day;
            $files  = $productReviewService->getFile("*$fileNameFormat*");
            foreach ($files as $file) {
                $contentArray = $productReviewService->xmlToArray($file->getContents());
                try {
                    if (isset($contentArray['review'])) {
                        //If action key is set at this level this mean we have only one review in file
                        if (isset($contentArray['review']['action'])) {
                            $review = $contentArray['review'];
                            $this->importReview($review);
                        } else {
                            //Else we have many review so import all
                            foreach ($contentArray['review'] as $review) {
                                $this->importReview($review);
                            }
                        }
                    }
                } catch (\Exception $e) {
                    NetReviews::log("One review was not imported in file $fileNameFormat, error :".$e->getMessage());
                    $output->writeln($e->getMessage());
                    $output->writeln(print_r($contentArray));
                }
            }
        }

        NetReviews::setConfigValue(NetReviews::LAST_IMPORT_KEY, (new \DateTime())->getTimestamp());
    }

    protected function executeApiImport(InputInterface $input, OutputInterface $output)
    {
        $productReviewCountUrl = NetReviews::getConfigValue("api_all_products_url");
        $productReviewCounts = (array) json_decode(file_get_contents($productReviewCountUrl));

        foreach ($productReviewCounts as $productReviewCount) {
            $netReviewsProductId = $productReviewCount->id_product;
            $databaseReviewsCount = NetreviewsProductReviewQuery::create()
                ->filterByProductRef($netReviewsProductId)->count();

            if ($databaseReviewsCount === (int) $productReviewCount->nb_reviews) {
                continue;
            }

            $product = ProductQuery::create()->findOneByRef($netReviewsProductId);

            if (null === $product) {
                continue;
            }

            $productReviewsUrl = NetReviews::getConfigValue("api_one_product_url");
            $productReviewsUrl = str_replace('[id_product]', $netReviewsProductId, $productReviewsUrl);
            $productReviews = (array) json_decode(file_get_contents($productReviewsUrl));

            foreach ($productReviews as $productReview) {
                if (null !== NetreviewsProductReviewQuery::create()->filterByReviewId()->filterByProductReviewId($productReview->id_review)->findOne()) {
                    continue;
                }

                $newReview = new NetreviewsProductReview();
                $newReview
                    ->setProductReviewId($productReview->id_review_product)
                    ->setReviewId($productReview->id_review)
                    ->setLastname($productReview->lastname)
                    ->setFirstname($productReview->firstname)
                    ->setReviewDate($productReview->review_date)
                    ->setMessage($productReview->review)
                    ->setRate($productReview->rate)
                    ->setOrderRef($productReview->order_ref)
                    ->setProductRef($productReview->id_product)
                    ->setProductId($product->getId());
                $newReview->save();
            }
        }

    }

    protected function importReview($review)
    {
        /** @var ProductReviewService $productReviewService */
        $productReviewService = $this->getContainer()->get('netreviews.product_review.service');

        switch ($review['action']) {
            case 'NEW':
                $productReviewService->createOrUpdateReview($review);
                break;
            case 'UPDATE':
                $productReviewService->createOrUpdateReview($review);
                break;
            case 'DELETE':
                $productReviewService->deleteReview($review);
                break;
            default:
                NetReviews::log("Review action not recognized : " . $review['action']);
        }
    }
}
