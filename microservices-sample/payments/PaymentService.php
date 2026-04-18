<?php

namespace Microservices\Sample\Payments;

class PaymentService
{
    public function processPayment($amount, $method)
    {
        // Logic to process payment
        return ['status' => 'paid', 'amount' => $amount];
    }

    public function getPaymentHistory($userId)
    {
        // Logic to get payment history
        return ['history' => []];
    }
}

?>