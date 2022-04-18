<?php

use App\Models\Bookable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FiltersController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\BookableController;
use App\Http\Controllers\Api\CheckoutController;
use App\Http\Controllers\Api\BookableImageController;
use App\Http\Controllers\Api\BookablePriceController;
use App\Http\Controllers\Api\BookableReviewController;
use App\Http\Controllers\Api\BookingByReviewController;
use App\Http\Controllers\Api\BookableAvailabilityController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::apiResource('bookables', BookableController::class);
Route::get('bookables/{bookable}/availability', BookableAvailabilityController::class)
    ->name('bookables.availability.show');
Route::get('bookables/{bookable}/reviews', BookableReviewController::class)
    ->name('bookables.reviews.index');
Route::get('bookables/{bookable}/images', BookableImageController::class)
    ->name('bookables.images.index');
Route::get('bookables/{bookable}/price', BookablePriceController::class)
    ->name('bookables.price.show');

Route::get('/booking-by-review/{reviewKey}', BookingByReviewController::class)
    ->name('booking.by-review.show');

Route::apiResource('reviews', ReviewController::class)->only(['show', 'store']);

Route::post('checkout', CheckoutController::class)->name('checkout');

Route::get('filters', FiltersController::class)->name('bookables.filters');