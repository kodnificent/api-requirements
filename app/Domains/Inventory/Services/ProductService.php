<?php

namespace App\Domains\Inventory\Services;

use App\Domains\Inventory\Contracts\ProductServiceContract;
use App\Domains\Inventory\Models\Product;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Arr;

class ProductService implements ProductServiceContract
{
    public function productList(
        array $filters = [],
        $page = 1,
        $per_page = 20
    ): Paginator
    {
        $query = Product::query();
        $filters = Arr::only($filters, ['price', 'category']);

        foreach($filters as $key => $value) {
            $query = $query->where($key, $value);
        }

        return $query->simplePaginate(perPage: $per_page, page: $page);
    }
}
