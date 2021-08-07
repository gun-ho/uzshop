<?php

namespace App\Http\Resources\Product;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductCollection extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        /**
         * @var Product $this
         */
        return [
            'name'        => $this->name,
            'price'       => $this->price,
            'discount'    => $this->discount,
            'single-link' => route('product.show', $this->id),
        ];
    }
}
