<?php

namespace NetReviews\Controller;

use NetReviews\NetReviews;
use NetReviews\Service\OrderService;
use Thelia\Controller\Admin\BaseAdminController;
use Thelia\Core\Security\AccessManager;
use Thelia\Core\Security\Resource\AdminResources;
use Thelia\Core\Translation\Translator;

class OrderController extends BaseAdminController
{
    public function sendAction($orderId)
    {
        if (null !== $response = $this->checkAuth(array(AdminResources::MODULE), 'NetReviews', AccessManager::VIEW)) {
            return $response;
        }

        $form = $this->createForm("netreviews_send_order_form");

        try {
            $data = $this->validateForm($form)->getData();

            /** @var OrderService $orderService */
            $orderService = $this->container->get('netreviews.order.service');

            $response = $orderService->sendOrderToNetReviews($orderId);
            $return = $response->return;

            if ($return != 1) {
                $debug = $response->debug;
                throw new \Exception($debug);
            }
        } catch (\Exception $e) {
            $this->setupFormErrorContext(
                Translator::getInstance()->trans(
                    "Error",
                    [],
                    NetReviews::DOMAIN_NAME
                ),
                $e->getMessage(),
                $form
            );
        }

        return $this->generateSuccessRedirect($form);
    }
}