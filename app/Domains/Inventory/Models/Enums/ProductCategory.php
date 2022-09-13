<?php

namespace App\Domains\Inventory\Models\Enums;

enum ProductCategory: string
{
    case VEHICLE = 'vehicle';
    case INSURANCE = 'insurance';
}
