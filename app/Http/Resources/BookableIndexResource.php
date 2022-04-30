<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookableIndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $property_types = config('bookable.propertyTypes');

        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'bedrooms' => $this->bedrooms,
            'bathrooms' => $this->bathrooms,
            'picture' => $this->getFirstMediaUrl('picture'),
            'rating' => $this->rating,
            'reviewCount' => $this->reviewCount,
            'propertyType' => $property_types[$this->property_type],
        ];
    }
}
