<?php

namespace App\Domains\Inventory\Http\Controllers;

use App\Domains\Inventory\Contracts\ProductServiceContract;
use App\Domains\Inventory\Http\Resources\ProductResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(protected ProductServiceContract $service) {}

    public function index(Request $request) {
        $list = $this->service->productList(filters: $request->query());

        return ProductResource::collection($list);
    }
}
