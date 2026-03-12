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
                "api_key",
                "text",
                [
                    "data" => NetReviews::getConfigValue("api_key"),
                    "label"=>Translator::getInstance()->trans("API Key (Skeepers)", array(), NetReviews::DOMAIN_NAME),
                    "label_attr" => ["for" => "api_key"],
                    "required" => true
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
        ;
    }

    public function getName()
    {
        return "netreviews_configuration_form";
    }
}
