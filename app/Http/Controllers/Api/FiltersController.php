<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        return response()->json([
            'bedrooms' => [
                1,
                2,
                4
            ],
            'bathrooms' => [
                1,
                2,
                4
            ],
            'propertyTypes' => [
                1 => 'House',
                2 => 'Apartment',
                3 => 'Loft'
            ],
            'priceRanges' => [
                2000, 3000, 40000
            ],
            'amenities' => [
                1 => 'Balcony',
                2 => 'Pool',
                3 => 'Beach'
            ]
        ]);
    }
}
