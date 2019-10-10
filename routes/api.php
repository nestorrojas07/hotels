<?php

use Illuminate\Http\Request;

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

//::middleware('auth:api');

\Illuminate\Support\Facades\Route::apiResource('hotelsgroups', '\App\Http\Controllers\GroupHotelController');
\Illuminate\Support\Facades\Route::apiResource('hotels', '\App\Http\Controllers\HotelController');
Route::get('/v1/grouphotels', function (Request $request) {
    return \App\Http\Resources\GroupHotelResource::collection(\App\Models\GroupHotel::simplePaginate(2));
});
