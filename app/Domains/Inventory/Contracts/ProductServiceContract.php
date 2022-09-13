<?php

namespace App\Domains\Inventory\Contracts;

use Illuminate\Contracts\Pagination\Paginator;

interface ProductServiceContract
{
    /**
     * Get product list.
     */
    public function productList(
        array $filters = [],
        $page = 1,
        $per_page = 20
    ): Paginator;
}
