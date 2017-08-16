<?php


namespace NetReviews\Controller;

use NetReviews\NetReviews;
use Thelia\Controller\Admin\BaseAdminController;
use Thelia\Core\Security\AccessManager;
use Thelia\Core\Security\Resource\AdminResources;
use Thelia\Core\Translation\Translator;

class ConfigurationController extends BaseAdminController
{
    public function viewAction()
    {
        return $this->render(
            "netreviews/configuration",
            [
                "id_web_site" => NetReviews::getConfigValue('id_web_site'),
                "token" => NetReviews::getConfigValue('token')
            ]
        );
    }

    public function saveAction()
    {
        if (null !== $response = $this->checkAuth(array(AdminResources::MODULE), 'NetReviews', AccessManager::VIEW)) {
            return $response;
        }

        $form = $this->createForm("netreviews_configuration.form");

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
            return $this->viewAction();
        }

        return $this->generateSuccessRedirect($form);
    }
}
