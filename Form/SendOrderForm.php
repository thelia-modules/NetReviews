<?php

declare(strict_types=1);

namespace NetReviews\Form;

use Thelia\Form\BaseForm;

class SendOrderForm extends BaseForm
{
    protected function buildForm()
    {

    }

    public static function getName(): string
    {
        return "netreviews_send_order_form";
    }
}