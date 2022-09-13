<?php

namespace App\Domains\Inventory\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'sku' => $this->sku,
            'name' => $this->name,
            'category' => $this->category,
            'price' => [
                'original' => $this->original_price,
                'final' => $this->final_price,
                'discount_percentage' => $this->price_discount_display,
                'currency' => $this->price_currency
            ],
        ];
    }
}
