<?php

declare(strict_types=1);

namespace NetReviews\Controller;

use NetReviews\Form\SendOrderForm;
use NetReviews\NetReviews;
use NetReviews\Service\OrderService;
use Thelia\Controller\Admin\BaseAdminController;
use Thelia\Core\Security\AccessManager;
use Thelia\Core\Security\Resource\AdminResources;
use Thelia\Core\Translation\Translator;

// Route declared in Config/routing.xml (registers on both Thelia 2 and Thelia 3).
class OrderController extends BaseAdminController
{
    public function sendAction($orderId, OrderService $orderService)
    {
        if (null !== $response = $this->checkAuth(array(AdminResources::MODULE), 'NetReviews', AccessManager::VIEW)) {
            return $response;
        }

        $form = $this->createForm(SendOrderForm::getName());

        try {
            $data = $this->validateForm($form)->getData();

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