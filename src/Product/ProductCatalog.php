<?php

declare(strict_types=1);

namespace LaravelCommerceEngine\Product;

/**
 * Product catalog management
 */
final class ProductCatalog
{
    /** @var array<string, array<string, mixed>> */
    private array $products = [];

    public function addProduct(string $id, string $name, float $price, int $stock = 0): void
    {
        $this->products[$id] = [
            'id' => $id,
            'name' => $name,
            'price' => $price,
            'stock' => $stock,
        ];
    }

    /**
     * @return array<string, mixed>|null
     */
    public function getProduct(string $id): ?array
    {
        return $this->products[$id] ?? null;
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public function getAllProducts(): array
    {
        return $this->products;
    }

    public function updateStock(string $id, int $quantity): void
    {
        if (isset($this->products[$id])) {
            $this->products[$id]['stock'] = $quantity;
        }
    }

    public function hasStock(string $id, int $quantity): bool
    {
        $product = $this->getProduct($id);
        return $product && $product['stock'] >= $quantity;
    }
}
