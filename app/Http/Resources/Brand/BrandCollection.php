<?php

namespace App\Http\Resources\Brand;

use App\Models\Brand;
use Illuminate\Http\Resources\Json\JsonResource;

class BrandCollection extends JsonResource
{
    /**
     * @param $request
     * @return array
     */
    public function toArray($request): array
    {
        /** @var Brand $this */
        return[
            'name'  => $this->name,
            'image' => $this->image->getUrl()
        ];
    }
}
