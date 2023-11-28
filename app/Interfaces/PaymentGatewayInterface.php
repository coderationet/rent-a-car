<?php

namespace App\Interfaces;

interface PaymentGatewayInterface
{
    public function get_payment_gateway_id();
    public function get_payment_gateway_status();
    public function get_payment_gateway_name();
    public function get_payment_gateway_description();
    public function get_payment_gateway_settings();
    public function get_payment_gateway_icon();
    public function get_payment_is_button_enabled();
    public function get_payment_button_text();
    public function payment_form();
    public function payment_result();
    public function confirm_payment();
}
