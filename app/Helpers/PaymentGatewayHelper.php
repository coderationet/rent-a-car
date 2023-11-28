<?php

namespace App\Helpers;

class PaymentGatewayHelper{
    public static function get_payment_gateways($only_active = false){
        $payment_gateways = [];

        $gateway_files = glob(app_path('Modules/Payment/*.php'));

        foreach ($gateway_files as $gateway_file) {
            $gateway_class = 'App\\Modules\\Payment\\' . basename($gateway_file, '.php');
            $gateway = new $gateway_class();
            if ($only_active && !$gateway->get_payment_gateway_status()) {
                continue;
            }
            $payment_gateways[$gateway->get_payment_gateway_id()] = $gateway;
        }
        return $payment_gateways;
    }
}
