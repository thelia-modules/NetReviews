<?php

declare(strict_types=1);

namespace NetReviews\Controller;

use NetReviews\Form\ConfigurationForm;
use NetReviews\NetReviews;
use Symfony\Component\Routing\Attribute\Route;
use Thelia\Controller\Admin\BaseAdminController;
use Thelia\Core\Security\AccessManager;
use Thelia\Core\Security\Resource\AdminResources;
use Thelia\Core\Translation\Translator;
use Thelia\Tools\URL;

#[Route('/admin/module/netreviews', name: 'admin_netreviews_config')]
class ConfigurationController extends BaseAdminController
{
    #[Route('/configuration', name: '_save', methods: ['POST'])]
    public function saveAction()
    {
        if (null !== $response = $this->checkAuth(array(AdminResources::MODULE), 'NetReviews', AccessManager::VIEW)) {
            return $response;
        }

        $form = $this->createForm(ConfigurationForm::getName());

        try {
            $data = $this->validateForm($form)->getData();

            $excludeData = [
                'success_url',
                'error_url',
                'error_message',
                'status_to_export'
            ];

            foreach ($data as $key => $value) {
                if (!in_array($key, $excludeData)) {
                    NetReviews::setConfigValue($key, $value);
                } elseif ($key === 'status_to_export') {
                    NetReviews::setConfigValue('status_to_export', implode(',', $value));
                }
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

            return $this->generateErrorRedirect($form)
                ?? $this->generateRedirect(URL::getInstance()->absoluteUrl('/admin/module/NetReviews'));
        }

        return $this->generateSuccessRedirect($form);
    }
}
