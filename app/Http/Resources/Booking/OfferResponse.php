<?php

namespace App\Http\Resources\Booking;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferResponse extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'type' => $this->type,
            // Capacity
            'max_adults' => $this->max_adults,
            'max_childs' => $this->max_childs,
            // Prices
            'price_adult' => $this->price_adult,
            'price_child' => $this->price_child,
        ];
    }
}
