<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookableShowResource extends JsonResource
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
            'bedrooms' => $this->bedrooms,
            'bathrooms' => $this->bathrooms,
            'propertyType' => $property_types[$this->property_type],
            'amenities' => $this->tagsWithType('amenities')->pluck('name'),
        ];
    }
}
