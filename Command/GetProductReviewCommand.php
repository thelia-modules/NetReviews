<?php

namespace NetReviews\Command;

use NetReviews\NetReviews;
use NetReviews\Service\ProductReviewService;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Thelia\Command\ContainerAwareCommand;

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
