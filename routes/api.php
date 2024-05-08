<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController\v1\HotelController;
use App\Http\Controllers\ApiController\v1\SearchController;

Route::prefix('v1')->group(function () {
    Route::apiResource('hotels', HotelController::class);
    Route::get('/search', SearchController::class);
});
