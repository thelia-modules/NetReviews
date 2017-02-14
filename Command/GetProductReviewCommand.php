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
        $allTheFile = $input->getOption('all_file');
        /** @var ProductReviewService $productReviewService */
        $productReviewService = $this->getContainer()->get('netreviews.product_review.service');
        $idWebsite = NetReviews::getConfigValue('id_website');

        $fileNameFormat = $idWebsite;
        if (false == $allTheFile) {
            $year = (new \DateTime())->format('Y');
            $month = (new \DateTime())->format('m');
            $day = (new \DateTime())->format('d');
            $fileNameFormat .= "_$year$month$day";
        }

        $files  = $productReviewService->getFile("*$fileNameFormat*");

        foreach ($files as $file) {
            $contentArray = $productReviewService->xmlToArray($file->getContents());

            if (isset($contentArray['review'])) {
                foreach ($contentArray['review'] as $review) {
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
                            NetReviews::log("Review action not recognized : ".$review['action']);
                    }
                }
            }

        }

    }
}
