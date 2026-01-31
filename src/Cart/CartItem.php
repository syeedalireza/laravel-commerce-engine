<?php

declare(strict_types=1);

namespace LaravelCommerceEngine\Cart;

/**
 * Shopping cart item value object
 */
final class CartItem
{
    public function __construct(
        private readonly string $productId,
        private readonly string $name,
        private readonly int $quantity,
        private readonly float $price
    ) {
    }

    public function getProductId(): string
    {
        return $this->productId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getSubtotal(): float
    {
        return $this->quantity * $this->price;
    }

    public function withQuantity(int $quantity): self
    {
        return new self(
            $this->productId,
            $this->name,
            $quantity,
            $this->price
        );
    }
}
