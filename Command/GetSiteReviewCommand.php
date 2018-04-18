<?php

namespace NetReviews\Command;

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
        $url_review = NetReviews::getConfigValue('site_url_import');

        if($url_review){
            try {
                $unparsed_json = file_get_contents($url_review);

                $tabReviews = json_decode($unparsed_json);

                $this->siteReviewService = $this->getContainer()->get('netreviews.site_review.service');

                foreach ($tabReviews as $review) {
                    switch ($review->state) {
                        case '4':
                            $this->siteReviewService->addRow($review);
                            break;
                        case 'UPDATE':
                            $this->siteReviewService->updateRow($review);
                            break;
                        case 'DELETE':
                            $this->siteReviewService->delRow($review);
                            break;
                        default:
                            NetReviews::log("Review action not recognized : " . $review->state);
                    }
                }

                $this->generateGlobalRateSite();
            }
            catch(\Exception $e) {
                NetReviews::log("Site Rewiews error :".$e->getMessage());
                $output->writeln($e->getMessage());
            }

        } else {
            NetReviews::log('Url import site reviews empty');
            $output->writeln(print_r('ERROR --> Url import site reviews empty'));
        }
    }

    private function generateGlobalRateSite()
    {
        $fileRateJson = __DIR__ . "/rate.json";

        if (($handle = fopen($fileRateJson, 'w+')) !== FALSE) {

            $average = $this->siteReviewService->calculSiteRate();

            $tabAverage = array('rate_site' => $average);

            $jsonAverage = json_encode($tabAverage);

            fwrite($handle, $jsonAverage);
        }
        fclose($handle);
    }
}