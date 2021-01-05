<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bookable;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class BookablePriceController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function __invoke($id, Request $request)
    {
        $bookable = Bookable::findOrFail($id);

        $data = $request->validate([
            'from' => 'required|date_format:Y-m-d',
            'to' => 'required|date_format:Y-m-d|after_or_equal:fro'
        ]);

        $days = (new Carbon($data['from']))->diffInDays(new Carbon($data['to'])) + 1;
        $price = $days * $bookable->price;

        return response()->json([
            'data' => [
                'total' => $price,
                'breakdown' => [
                    $bookable->price => $days
                ]
            ]
        ]);

    }
}
