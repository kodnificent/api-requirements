<?php

namespace App\Domains\Inventory\Providers;

use App\Domains\Inventory\Contracts\ProductServiceContract;
use App\Domains\Inventory\Services\ProductService;
use Illuminate\Support\ServiceProvider;

class InventoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        app()->bind(ProductServiceContract::class, fn () => new ProductService);
    }
}
