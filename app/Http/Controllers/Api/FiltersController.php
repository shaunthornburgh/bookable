<?php

namespace App\Http\Controllers\Api;

use Spatie\Tags\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bookable;

class FiltersController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $bookables = Bookable::all();

        return response()->json([
            'bedrooms' => $bookables->unique('bedrooms')->sortBy('bedrooms')->pluck('bedrooms'),
            'bathrooms' => $bookables->unique('bathrooms')->sortBy('bathrooms')->pluck('bathrooms'),
            'propertyTypes' => config('bookable.propertyTypes'),
            'priceRanges' => collect(config('bookable.priceRanges'))->keys(),
            'amenities' => Tag::getWithType('amenities')->pluck('name', 'id')
        ]);
    }
}
