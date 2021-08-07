<?php

namespace App\Http\Resources\Product;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        /**
         * @var Product $this
         */
        return [
            'name'        => $this->name,
            'description' => $this->detail,
            'price'       => $this->price,
            'stock'       => $this->stock,
            'discount'    => $this->discount,
            'created_at'  => $this->created_at,
            'reviews'     => route('review.list', $this->id),
        ];
    }
}
