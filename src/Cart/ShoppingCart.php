<?php

declare(strict_types=1);

namespace LaravelCommerceEngine\Cart;

/**
 * Shopping cart management
 */
final class ShoppingCart
{
    /** @var array<string, CartItem> */
    private array $items = [];

    public function addItem(string $productId, string $name, int $quantity, float $price): void
    {
        if (isset($this->items[$productId])) {
            $existingItem = $this->items[$productId];
            $newQuantity = $existingItem->getQuantity() + $quantity;
            $this->items[$productId] = $existingItem->withQuantity($newQuantity);
        } else {
            $item = new CartItem($productId, $name, $quantity, $price);
            $this->items[$productId] = $item;
        }
    }

    public function removeItem(string $productId): void
    {
        unset($this->items[$productId]);
    }

    public function updateQuantity(string $productId, int $quantity): void
    {
        if (isset($this->items[$productId])) {
            $this->items[$productId] = $this->items[$productId]->withQuantity($quantity);
        }
    }

    public function getItem(string $productId): ?CartItem
    {
        return $this->items[$productId] ?? null;
    }

    /**
     * @return array<string, CartItem>
     */
    public function getItems(): array
    {
        return $this->items;
    }

    public function getTotal(): float
    {
        return array_reduce(
            $this->items,
            fn($total, CartItem $item) => $total + $item->getSubtotal(),
            0.0
        );
    }

    public function getItemCount(): int
    {
        return array_reduce(
            $this->items,
            fn($count, CartItem $item) => $count + $item->getQuantity(),
            0
        );
    }

    public function clear(): void
    {
        $this->items = [];
    }

    public function isEmpty(): bool
    {
        return empty($this->items);
    }
}
