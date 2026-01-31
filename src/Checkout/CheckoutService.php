<?php

declare(strict_types=1);

namespace LaravelCommerceEngine\Checkout;

use LaravelCommerceEngine\Cart\ShoppingCart;
use LaravelCommerceEngine\Payment\PaymentGatewayInterface;

/**
 * Checkout process management
 */
final class CheckoutService
{
    public function __construct(
        private readonly PaymentGatewayInterface $paymentGateway
    ) {
    }

    /**
     * Process checkout
     *
     * @param ShoppingCart $cart
     * @param array<string, mixed> $customerData
     * @return array<string, mixed>
     */
    public function processCheckout(ShoppingCart $cart, array $customerData): array
    {
        if ($cart->isEmpty()) {
            throw new \RuntimeException('Cart is empty');
        }

        $total = $cart->getTotal();

        // Process payment
        $paymentResult = $this->paymentGateway->charge($total, $customerData);

        if (!$paymentResult['success']) {
            throw new \RuntimeException('Payment failed: ' . $paymentResult['message']);
        }

        // Clear cart after successful payment
        $cart->clear();

        return [
            'success' => true,
            'order_id' => $paymentResult['transaction_id'],
            'total' => $total,
        ];
    }
}
