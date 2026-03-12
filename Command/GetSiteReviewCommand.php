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
        $apiKey = NetReviews::getConfigValue('api_key');
        $idWebSite = NetReviews::getConfigValue('id_website');

        $apiUrl = "https://api.skeepers.io/v1/reviews/site";

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
            $tabReviews = json_decode($response);
            $this->siteReviewService = $this->getContainer()->get('netreviews.site_review.service');

            foreach ($tabReviews as $review) {
                $mappedReview = (object)[
                    'id_review' => $review->id ?? $review->id_review,
                    'lastname' => $review->customer->lastname ?? $review->lastname,
                    'firstname' => $review->customer->firstname ?? $review->firstname,
                    'review' => $review->comment ?? $review->review,
                    'review_date' => $review->date ?? $review->review_date,
                    'rate' => $review->rating ?? $review->rate,
                    'order_ref' => $review->order_reference ?? $review->order_ref,
                    'order_date' => $review->order_date ?? $review->order_date,
                    'state' => '4'
                ];

                $this->siteReviewService->addNetreviewsSiteRow($mappedReview);
            }

            $this->generateGlobalRateSite();
        } else {
            $output->writeln("<error>Skeepers API Error: $httpCode</error>");
        }
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