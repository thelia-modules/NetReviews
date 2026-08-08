<?php

namespace NetReviews\Smarty;

use NetReviews\NetReviews;
use NetReviews\Service\SiteReviewService;
use TheliaSmarty\Template\AbstractSmartyPlugin;
use TheliaSmarty\Template\SmartyPluginDescriptor;

class SiteReviews extends AbstractSmartyPlugin
{
    /** @var SiteReviewService */
    private $siteReviewService;

    public function __construct(SiteReviewService $siteReviewService)
    {
        $this->siteReviewService = $siteReviewService;
    }

    public function getPluginDescriptors()
    {
        return [
            new SmartyPluginDescriptor('function', 'site_reviews', $this, 'getSiteReviews')
        ];
    }

    /**
     * @param array $params
     * @param \Smarty_Internal_Template $smarty
     */
    public function getSiteReviews($smarty, $nbreReview = null)
    {
        /** @var SiteReviewService $siteReviewService */
        $reviews = $this->siteReviewService->getRows($nbreReview['limit']);

        $data = $reviews->getData();
        $data = $this->formatData($data);

        $smarty->assign('site_reviews', $data);

        /** @var SiteReviewService $siteReviewService */
        $siteRate = $this->siteReviewService->readRate();

        $smarty->assign('site_rate', $siteRate);
    }

    private function formatData($data)
    {
        if ($count = count($data)) {
            $tabRewiews = array();
            for ($i = 0; $i < $count; $i++) {
                $tabRewiews[$i]['rate'] = $data[$i]->getRate();
                $tabRewiews[$i]['review_date'] = $data[$i]->getReviewDate();
                $tabRewiews[$i]['firstname'] = $data[$i]->getFirstname();
                $tabRewiews[$i]['lastname'] = $data[$i]->getLastname();
                $tabRewiews[$i]['order_date'] = $data[$i]->getOrderDate();
                $tabRewiews[$i]['review'] = $data[$i]->getReview();
            }

            return $tabRewiews;
        }
    }
}
