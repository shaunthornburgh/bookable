<?php

namespace App\Models;

use Carbon\Carbon;
use Spatie\Tags\Tag;
use Spatie\Tags\HasTags;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bookable extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasTags;

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('picture');
        $this->addMediaCollection('gallery');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function getRatingAttribute()
    {
        return floatval( $this->reviews()->avg('rating') );
    }

    public function getReviewCountAttribute()
    {
        return $this->reviews()->count();
    }

    public function availableFor($from, $to): bool
    {
        return 0 === $this->bookings()->betweenDates($from, $to)->count();
    }

    public function pricefor($from, $to): array
    {
        $days = (new Carbon($from))->diffInDays(new Carbon($to)) + 1;
        $price = $days * $this->price;

        return [
            'total' => $price,
            'breakdown' => [
                $this->price => $days
            ]
        ];
    }

    public function scopeFiltered($query, $bedrooms, $bathrooms, $priceRange, $propertyType, $amenities){
        $query
            ->when($bedrooms, function($query) use ($bedrooms){
                $query->whereBedrooms($bedrooms);
            })

            ->when($bathrooms, function($query) use ($bathrooms){
                $query->whereBathrooms($bathrooms);
            })

            ->when($priceRange, function($query) use ($priceRange){
                $rangeFromToArray = config("bookable.priceRanges.{$priceRange}");
                $query->whereBetween('price', $rangeFromToArray);
            })

            ->when($propertyType, function($query) use ($propertyType){
                $query->wherePropertyType($propertyType);
            })

            ->when($amenities, function($query) use ($amenities){
                $tags = Tag::findMany( explode(',', $amenities) );
                $query->withAllTags($tags);
            });

        return $query;
    }
}
