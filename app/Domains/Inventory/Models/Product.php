<?php

namespace App\Domains\Inventory\Models;

use App\Domains\Inventory\Models\Enums\ProductCategory;
use Database\Factories\Domains\Inventory\ProductFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $casts = [
        'category' => ProductCategory::class,
    ];

    protected static function booted()
    {
        static::created(function (Product $product) {
            if ($product->sku === null) {
                $product->setSku();
                $product->save();
            }
        });
    }

    protected static function newFactory()
    {
        return ProductFactory::new();
    }

    protected function originalPrice(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->price
        );
    }

    protected function finalPrice(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->price_discount === null) {
                    return $this->price;
                }

                $discount = ($this->price_discount / 100) * $this->price;

                return $this->price - $discount;
            }
        );
    }

    protected function priceCurrency(): Attribute
    {
        return Attribute::make(
            get: fn () => 'EUR'
        );
    }

    protected function priceDiscount(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->category === ProductCategory::INSURANCE) {
                    return 30;
                }

                if ($this->sku === '000003') {
                    return 15;
                }

                return null;
            }
        );
    }

    protected function priceDiscountDisplay(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->price_discount === null ? null : (string) $this->price_discount . '%'
        );
    }

    /**
     * Set the sku value of the product.
     */
    public function setSku(): void
    {
        $this->sku = str_pad($this->id, 6, '0', STR_PAD_LEFT);
    }
}
