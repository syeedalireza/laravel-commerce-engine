<?php

declare(strict_types=1);

namespace LaravelCommerceEngine\Payment;

/**
 * Payment gateway interface
 */
interface PaymentGatewayInterface
{
    /**
     * Charge a payment
     *
     * @param float $amount
     * @param array<string, mixed> $customerData
     * @return array<string, mixed>
     */
    public function charge(float $amount, array $customerData): array;

    /**
     * Refund a payment
     *
     * @param string $transactionId
     * @param float $amount
     * @return array<string, mixed>
     */
    public function refund(string $transactionId, float $amount): array;

    /**
     * Get gateway name
     */
    public function getName(): string;
}
