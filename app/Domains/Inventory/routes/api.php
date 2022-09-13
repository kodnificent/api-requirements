<?php

use App\Domains\Inventory\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('inventory')
    ->name('inventory.')
    ->group(function() {
        Route::get('products', [ProductController::class, 'index'])->name('products.index');
    });
