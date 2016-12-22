<?php

namespace NetReviews\Form;

use NetReviews\NetReviews;
use Thelia\Core\Translation\Translator;
use Thelia\Form\BaseForm;

class ConfigurationForm extends BaseForm
{
    protected function buildForm()
    {
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
                "site_widget_code",
                "text",
                [
                    "data" => NetReviews::getConfigValue("site_widget_code"),
                    "label"=>Translator::getInstance()->trans("Site widget code", array(), NetReviews::DOMAIN_NAME)
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
            );
    }

    public function getName()
    {
        return "netreviews_configuration_form";
    }
}
