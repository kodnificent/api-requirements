<?php

namespace Database\Factories\Domains\Inventory;

use App\Domains\Inventory\Models\Enums\ProductCategory;
use App\Domains\Inventory\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Model>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(4),
            'category' => $this->faker->randomElement(ProductCategory::cases()),
            'price' => $this->faker->randomElement([50000, 100000, 25000, 10000, 2000])
        ];
    }
}
