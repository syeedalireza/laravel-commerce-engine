<?php

declare(strict_types=1);

namespace LaravelCommerceEngine\Providers;

use Illuminate\Support\ServiceProvider;
use LaravelCommerceEngine\Cart\ShoppingCart;

class CommerceServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ShoppingCart::class, function () {
            return new ShoppingCart();
        });
    }

    public function boot(): void
    {
        // Publish migrations if needed
    }
}
