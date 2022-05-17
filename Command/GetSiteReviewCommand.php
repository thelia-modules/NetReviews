<?php

namespace NetReviews\Command;

use NetReviews\Model\NetreviewsSiteReviewQuery;
use NetReviews\NetReviews;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Thelia\Command\ContainerAwareCommand;
use NetReviews\Service\SiteReviewService;

class GetSiteReviewCommand extends ContainerAwareCommand
{
    /** @var SiteReviewService $siteReviewService */
    private $siteReviewService;

    public function configure()
    {
        $this
            ->setName("module:NetReviews:GetSiteReview")
            ->setDescription("Get site review from URL")
            ->addOption(
                'json',
                'json',
                InputOption::VALUE_REQUIRED,
                'import json data',
                true
            );
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $urlReviews = NetReviews::getConfigValue('site_url_import');

        $deleteOldEntries = NetreviewsSiteReviewQuery::create()
            ->filterByReviewDate(array('max' => date("d-m-Y H:i:s", strtotime('-12 months'))))
            ->delete();

        if ($urlReviews) {
            try {
                $unparsedJson = file_get_contents($urlReviews);

                $tabReviews = json_decode($unparsedJson);

                $this->siteReviewService = $this->getContainer()->get('netreviews.site_review.service');

                foreach ($tabReviews as $review) {
                    switch ($review->state) {
                        case '6':
                            $this->siteReviewService->addNetreviewsSiteRow($review);
                            break;
                        /*case 'UPDATE':
                            $this->siteReviewService->updateNetreviewsSiteRow($review);
                            break;
                        case 'DELETE':
                            $this->siteReviewService->deleteNetreviewsSiteRow($review);
                            break;*/
                        default:
                            NetReviews::log("Site review action not recognized : " . $review->state);
                    }
                }

                $this->generateGlobalRateSite();

            } catch (\Exception $e) {
                NetReviews::log("Site Rewiews ERROR :" . $e->getMessage());
                $output->writeln($e->getMessage());
            }

        } else {
            NetReviews::log('Url import site reviews empty');
            $output->writeln(print_r('ERROR --> Url import site reviews empty'));
        }

        return 1;
    }

    private function generateGlobalRateSite()
    {
        $fileRateJson = __DIR__ . "/rate.json";

        if (($handle = fopen($fileRateJson, 'w+')) !== false) {

            $average = $this->siteReviewService->calculateSiteRate();

            $tabAverage = array('rate_site' => $average);

            $jsonAverage = json_encode($tabAverage);

            fwrite($handle, $jsonAverage);
        }
        fclose($handle);
    }
}