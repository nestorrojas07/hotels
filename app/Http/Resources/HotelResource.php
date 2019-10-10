<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HotelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->uuid,
            'hotelGroup'=> GroupHotelResource::make($this->hotelGroup)->toArray($request),
            'name' => $this->name,
            'image' => $this->image,
            'address' => $this->address,
            'city' => $this->city,
            'starts' => $this->starts,
            'created_at' => $this->created_at,
        ];

    }
}
