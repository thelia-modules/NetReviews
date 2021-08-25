<?php


namespace NetReviews\Controller;

use NetReviews\Form\ConfigurationForm;
use NetReviews\NetReviews;
use Thelia\Controller\Admin\BaseAdminController;
use Thelia\Core\Security\AccessManager;
use Thelia\Core\Security\Resource\AdminResources;
use Thelia\Core\Translation\Translator;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/module/netreviews", name="admin_netreviews_config")
 */
class ConfigurationController extends BaseAdminController
{

    /**
     * @Route("/configuration", name="_save", methods="POST")
     */
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
            return $this->viewAction();
        }

        return $this->generateSuccessRedirect($form);
    }
}
