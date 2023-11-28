<?php

namespace App\Modules\Payment;

use App\Helpers\Option;
use App\Interfaces\PaymentGatewayInterface;


class BankTransferPaymentGateway implements PaymentGatewayInterface
{
    public function get_payment_gateway_id()
    {
        return 'bank_transfer';
    }

    public function get_payment_gateway_status()
    {
        return Option::get('bank_transfer_payment_status',true,false);
    }

    public function get_payment_gateway_order()
    {
        return Option::get('bank_transfer_payment_order',1,1);
    }

    public function get_payment_gateway_name()
    {
        return 'Bank Transfer';
    }

    public function get_payment_gateway_description()
    {
        return 'Pay with Bank Transfer';
    }

    public function get_payment_gateway_settings()
    {
        // TODO: Implement get_payment_gateway_settings() method.
        return [
            $this->get_payment_gateway_id().'_'.'_bank_details_page_id' => [
                'required' => true,
                'label' => 'Page ID',
                'description' => 'Page ID to redirect after payment',
                'type' => 'text'
            ],
        ];
    }

    public function get_payment_gateway_icon()
    {
        return '<i class="fa fa-bank"></i>';
    }

    public function get_payment_is_button_enabled()
    {
        // TODO: Implement get_payment_is_button_enabled() method.
        return true;
    }

    public function get_payment_button_text()
    {
        // TODO: Implement get_payment_button_text() method.
        return 'Pay with Bank Transfer';
    }

    public function payment_form()
    {
        // TODO: Implement payment_form() method.

    }

    public function payment_result()
    {
        // TODO: Implement payment_result() method.
    }

    public function confirm_payment()
    {
        // TODO: Implement confirm_payment() method.

    }
}
