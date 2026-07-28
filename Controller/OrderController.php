<?php

declare(strict_types=1);

namespace NetReviews\Controller;

use NetReviews\Form\SendOrderForm;
use NetReviews\NetReviews;
use NetReviews\Service\OrderService;
use Symfony\Component\Routing\Attribute\Route;
use Thelia\Controller\Admin\BaseAdminController;
use Thelia\Core\Security\AccessManager;
use Thelia\Core\Security\Resource\AdminResources;
use Thelia\Core\Translation\Translator;

#[Route('/admin/module/netreviews/order', name: 'netreviews_order')]
class OrderController extends BaseAdminController
{
    #[Route('/{orderId}', name: '_send', methods: ['POST'], requirements: ['orderId' => '\d+'])]
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