<?php

namespace NetReviews\Command;

use NetReviews\NetReviews;
use NetReviews\Service\ProductReviewService;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Thelia\Command\ContainerAwareCommand;

class GetProductReviewCommand extends ContainerAwareCommand
{
    public function configure()
    {
        $this
            ->setName("module:NetReviews:GetProductReview")
            ->setDescription("Get products reviews from ftp");
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var ProductReviewService $productReviewService */
        $productReviewService = $this->getContainer()->get('netreviews.product_review.service');

        $files  = $productReviewService->getFile('all_reviews*');

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
