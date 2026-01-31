<?php

declare(strict_types=1);

namespace LaravelCommerceEngine\Payment;

interface PaymentGatewayInterface
{
    public function charge(float $amount, array $paymentDetails): string;
    public function refund(string $transactionId, float $amount): bool;
}
