<?php

declare(strict_types=1);

namespace LaravelCommerceEngine\Payment;

/**
 * PayPal payment gateway implementation
 */
final class PayPalPaymentGateway implements PaymentGatewayInterface
{
    public function __construct(
        private readonly string $clientId,
        private readonly string $clientSecret
    ) {
    }

    public function charge(float $amount, array $customerData): array
    {
        // Simulate PayPal API call
        return [
            'success' => true,
            'transaction_id' => 'PAYID-' . strtoupper(bin2hex(random_bytes(10))),
            'amount' => $amount,
            'gateway' => 'paypal',
            'message' => 'Payment successful',
        ];
    }

    public function refund(string $transactionId, float $amount): array
    {
        return [
            'success' => true,
            'refund_id' => 'REFUND-' . strtoupper(bin2hex(random_bytes(10))),
            'amount' => $amount,
            'message' => 'Refund successful',
        ];
    }

    public function getName(): string
    {
        return 'PayPal';
    }
}
