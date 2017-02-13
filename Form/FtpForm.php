<?php

namespace NetReviews\Form;

use NetReviews\NetReviews;
use Thelia\Core\Translation\Translator;
use Thelia\Form\BaseForm;
use Thelia\Model\OrderStatusQuery;

class FtpForm extends BaseForm
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
                "ftp_server",
                "text",
                [
                    "data" => NetReviews::getConfigValue("ftp_server"),
                    "label"=>Translator::getInstance()->trans("Ftp server", array(), NetReviews::DOMAIN_NAME),
                    "label_attr" => ["for" => "ftp_server"],
                    "required" => true
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
            );
    }

    public function getName()
    {
        return "netreviews_ftp_form";
    }
}