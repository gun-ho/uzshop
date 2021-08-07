<?php

namespace App\Http\Resources\Review;

use Symfony\Component\HttpFoundation\JsonResponse;

class ReviewCollection extends JsonResponse
{
    /**
     * @param $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'customer' => $this->customer,
            'text'     => $this->review,
        ];
    }
}
