<?php

namespace Tests\Feature\Domains\Inventory\Http\Controllers;

use App\Domains\Inventory\Models\Enums\ProductCategory;
use App\Domains\Inventory\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_product_list_endpoint_should_return_expected_structure()
    {
        Product::factory()->create();

        $url = route('inventory.products.index');

        $response = $this->get($url);
        $response->assertSuccessful()
            ->assertJsonStructure([
                'data',
                'links',
                'meta'
            ]);

        $data = $response->json('data');
        $this->assertCount(1, $data);
        $this->assertArrayHasKey('name', $data[0]);
        $this->assertArrayHasKey('sku', $data[0]);
        $this->assertArrayHasKey('price', $data[0]);
        $this->assertArrayHasKey('category', $data[0]);
    }

    public function test_product_list_endpoint_with_category_filter()
    {
        $insurance_count = 5;

        Product::factory()
            ->count($insurance_count)
            ->create(['category' => ProductCategory::INSURANCE]);

        Product::factory()
            ->count(30)
            ->create(['category' => ProductCategory::VEHICLE]);

        $url = route('inventory.products.index', ['category' => ProductCategory::INSURANCE->value]);
        $response = $this->get($url);
        $response->assertSuccessful();

        $this->assertCount($insurance_count, $data = $response->json('data'));

        foreach($data as $d) {
            $this->assertEquals(ProductCategory::INSURANCE->value, $d['category']);
        }
    }

    public function test_product_list_endpoint_with_price_filter()
    {
        $exp_count = 5;
        $price = 500000;

        Product::factory()
            ->count($exp_count)
            ->create(['price' => $price]);

        Product::factory()
            ->count(30)
            ->create(['price' => 10000]);

        $url = route('inventory.products.index', ['price' => $price]);
        $response = $this->get($url);
        $response->assertSuccessful();

        $this->assertCount($exp_count, $data = $response->json('data'));

        foreach($data as $d) {
            $this->assertEquals($price, $d['price']['original']);
        }
    }
}
