<?php

namespace NetReviews\Form;

use NetReviews\NetReviews;
use Thelia\Core\Translation\Translator;
use Thelia\Form\BaseForm;
use Thelia\Model\OrderStatusQuery;

class ConfigurationForm extends BaseForm
{
    protected function buildForm()
    {
        $orderStatus = [];

        $list = OrderStatusQuery::create()
            ->find();

        /** @var \Thelia\Model\OrderStatus $item */
        foreach ($list as $item) {
            $item->setLocale($this->getRequest()->getSession()->getLang()->getLocale());
            $orderStatus[$item->getId()] = $item->getTitle();
        }

        $this->formBuilder
            ->add(
                "id_website",
                "text",
                [
                    "data" => NetReviews::getConfigValue("id_website"),
                    "label"=>Translator::getInstance()->trans("Id website", array(), NetReviews::DOMAIN_NAME),
                    "label_attr" => ["for" => "id_website"],
                    "required" => true
                ]
            )
            ->add(
                "secret_token",
                "text",
                [
                    "data" => NetReviews::getConfigValue("secret_token"),
                    "label"=>Translator::getInstance()->trans("Secret token", array(), NetReviews::DOMAIN_NAME),
                    "label_attr" => ["for" => "secret_token"],
                    "required" => true
                ]
            )
            ->add(
                'api_url',
                'text',
                [
                    "data" => NetReviews::getConfigValue("api_url"),
                    "label"=>Translator::getInstance()->trans("Platform language", array(), NetReviews::DOMAIN_NAME),
                    "required" => false
                ]
            )
            ->add(
                'email_delay',
                'text',
                [
                    "data" => NetReviews::getConfigValue("email_delay", 3),
                    "label"=>Translator::getInstance()->trans("Reviews email delay (in days):", array(), NetReviews::DOMAIN_NAME),
                    "required" => false
                ]
            )
            ->add(
                'status_to_export',
                'choice',
                [
                    "data" => explode(',', NetReviews::getConfigValue("status_to_export")),
                    "label"=>Translator::getInstance()->trans("Order status to export", array(), NetReviews::DOMAIN_NAME),
                    "required" => false,
                    'multiple' => true,
                    'choices'  => $orderStatus
                ]
            )
            ->add(
                "footer_link_title",
                "text",
                [
                    "data" => NetReviews::getConfigValue("footer_link_title"),
                    "label"=>Translator::getInstance()->trans("Footer link title", array(), NetReviews::DOMAIN_NAME),
                    "required" => false
                ]
            )
            ->add(
                "footer_link",
                "text",
                [
                    "data" => NetReviews::getConfigValue("footer_link"),
                    "label"=>Translator::getInstance()->trans("Footer link", array(), NetReviews::DOMAIN_NAME),
                    "required" => false
                ]
            )
            ->add(
                "get_review_mode",
                'choice',
                [
                    "data" => NetReviews::getConfigValue("get_review_mode"),
                    "label"=>Translator::getInstance()->trans("Get review mode", array(), NetReviews::DOMAIN_NAME),
                    "required" => false,
                    'choices'  => [
                        'ftp'=>'ftp',
                        'local'=>'local'
                    ]
                ]
            )
            ->add(
                "review_local_path",
                "text",
                [
                    "data" => NetReviews::getConfigValue("review_local_path"),
                    "label"=>Translator::getInstance()->trans("Review local path", array(), NetReviews::DOMAIN_NAME),
                    "label_attr" => ["for" => "review_local_path"],
                    "required" => false
                ]
            )
            ->add(
                "ftp_server",
                "text",
                [
                    "data" => NetReviews::getConfigValue("ftp_server"),
                    "label"=>Translator::getInstance()->trans("Ftp server", array(), NetReviews::DOMAIN_NAME),
                    "label_attr" => ["for" => "ftp_server"],
                    "required" => false
                ]
            )
            ->add(
                "ftp_username",
                "text",
                [
                    "data" => NetReviews::getConfigValue("ftp_username"),
                    "label"=>Translator::getInstance()->trans("Ftp username", array(), NetReviews::DOMAIN_NAME),
                    "label_attr" => ["for" => "ftp_username"],
                    "required" => false
                ]
            )
            ->add(
                "ftp_password",
                "text",
                [
                    "data" => NetReviews::getConfigValue("ftp_password"),
                    "label"=>Translator::getInstance()->trans("Ftp password", array(), NetReviews::DOMAIN_NAME),
                    "required" => false
                ]
            )
            ->add(
                "ftp_port",
                "text",
                [
                    "data" => NetReviews::getConfigValue("ftp_port"),
                    "label"=>Translator::getInstance()->trans("Ftp port", array(), NetReviews::DOMAIN_NAME),
                    "required" => false
                ]
            )
            ->add(
                "ftp_directory",
                "text",
                [
                    "data" => NetReviews::getConfigValue("ftp_directory"),
                    "label"=>Translator::getInstance()->trans("Ftp directory", array(), NetReviews::DOMAIN_NAME),
                    "required" => false
                ]
            )
            ->add(
                'product_review_mode',
                'choice',
                [
                    "data" => NetReviews::getConfigValue("product_review_mode"),
                    "label"=>Translator::getInstance()->trans("Product review mode", array(), NetReviews::DOMAIN_NAME),
                    "required" => false,
                    'choices'  => [
                        'custom'=>'custom',
                        'iframe'=>'iframe'
                    ]
                ]
            )
            ->add(
                "site_widget_code",
                "text",
                [
                    "data" => NetReviews::getConfigValue("site_widget_code"),
                    "label"=>Translator::getInstance()->trans("Site widget code", array(), NetReviews::DOMAIN_NAME)
                ]
            )
            ->add(
                "site_url_import",
                "text",
                [
                    "data" => NetReviews::getConfigValue("site_url_import"),
                    "label"=>Translator::getInstance()->trans("Site url import", array(), NetReviews::DOMAIN_NAME)
                ]
            )
            ->add(
                "product_iframe_code",
                "text",
                [
                    "data" => NetReviews::getConfigValue("product_iframe_code"),
                    "label"=>Translator::getInstance()->trans("Product iframe code", array(), NetReviews::DOMAIN_NAME)
                ]
            )
            ->add(
                "display_product_review_exchanges",
                'choice',
                [
                    "data" => NetReviews::getConfigValue("display_product_review_exchanges"),
                    "required" => false,
                    'choices'  => [
                        'true' => 'true',
                        'false' => 'false'
                    ]
                ]
            )
            ->add(
                "debug_mode",
                'choice',
                [
                    "data" => NetReviews::getConfigValue("debug_mode", "false"),
                    "required" => false,
                    'choices'  => [
                        'true' => 'true',
                        'false' => 'false'
                    ]
                ]
            )
        ;
    }

    public function getName()
    {
        return "netreviews_configuration_form";
    }
}
