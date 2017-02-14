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

            NetReviews::setConfigValue('id_website', $data['id_website']);
            NetReviews::setConfigValue('secret_token', $data['secret_token']);
            NetReviews::setConfigValue('site_widget_code', $data['site_widget_code']);
            NetReviews::setConfigValue('product_iframe_code', $data['product_iframe_code']);
            NetReviews::setConfigValue('footer_link_title', $data['footer_link_title']);
            NetReviews::setConfigValue('footer_link', $data['footer_link']);
            NetReviews::setConfigValue('api_url', $data['api_url']);
            NetReviews::setConfigValue('email_delay', $data['email_delay']);
            NetReviews::setConfigValue('status_to_export', implode(',', $data['status_to_export']));
            NetReviews::setConfigValue('ftp_server', $data['ftp_server']);
            NetReviews::setConfigValue('ftp_username', $data['ftp_username']);
            NetReviews::setConfigValue('ftp_password', $data['ftp_password']);
            NetReviews::setConfigValue('ftp_port', $data['ftp_port']);
            NetReviews::setConfigValue('ftp_directory', $data['ftp_directory']);
            NetReviews::setConfigValue('product_review_mode', $data['product_review_mode']);
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
