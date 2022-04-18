<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookableIndexResource;
use App\Http\Resources\BookableShowResource;
use App\Models\Bookable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BookableController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        // TODO validation 
        $bookables = Bookable::filtered(
            request()->input('bedrooms'),
            request()->input('bathrooms'),
            request()->input('priceRange'),
            request()->input('propertyType'),
            request()->input('amenities'),
        )->get();

        return BookableIndexResource::collection($bookables);
    }

    /**
     * @param $id
     * @return BookableShowResource
     */
    public function show($id)
    {
        return new BookableShowResource(Bookable::findOrFail($id));
    }
}
