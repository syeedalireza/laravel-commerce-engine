<?php

declare(strict_types=1);

namespace LaravelCommerceEngine\Payment;

/**
 * Stripe payment gateway implementation
 */
final class StripePaymentGateway implements PaymentGatewayInterface
{
    public function __construct(
        private readonly string $apiKey
    ) {
    }

    public function charge(float $amount, array $customerData): array
    {
        // Simulate Stripe API call
        return [
            'success' => true,
            'transaction_id' => 'ch_' . bin2hex(random_bytes(12)),
            'amount' => $amount,
            'gateway' => 'stripe',
            'message' => 'Payment successful',
        ];
    }

    public function refund(string $transactionId, float $amount): array
    {
        return [
            'success' => true,
            'refund_id' => 're_' . bin2hex(random_bytes(12)),
            'amount' => $amount,
            'message' => 'Refund successful',
        ];
    }

    public function getName(): string
    {
        return 'Stripe';
    }
}
