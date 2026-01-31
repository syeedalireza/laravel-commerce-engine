<?php

declare(strict_types=1);

namespace LaravelCommerceEngine\Cart;

final class ShoppingCart
{
    private array $items = [];

    public function addItem(string $productId, int $quantity, float $price): void
    {
        if (isset($this->items[$productId])) {
            $this->items[$productId]['quantity'] += $quantity;
        } else {
            $this->items[$productId] = compact('quantity', 'price');
        }
    }

    public function getTotal(): float
    {
        return array_reduce(
            $this->items,
            fn ($carry, $item) => $carry + ($item['quantity'] * $item['price']),
            0.0
        );
    }

    public function getItemCount(): int
    {
        return array_sum(array_column($this->items, 'quantity'));
    }

    public function clear(): void
    {
        $this->items = [];
    }
}
