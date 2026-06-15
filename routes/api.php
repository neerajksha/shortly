<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiUrlController;

Route::prefix('v1')->middleware(['auth:sanctum','throttle:api-tokens'])->group(function () {

    Route::post('/shorten',[ApiUrlController::class, 'store']);
    Route::get('/urls',[ApiUrlController::class, 'index']);
    Route::get('/urls/{url}/analytics',[ApiUrlController::class, 'analytics']);
    Route::get('/urls/{url}/clicks',[ApiUrlController::class, 'clicks']);
    Route::put( '/urls/{url}',[ApiUrlController::class, 'update']);
    Route::delete('/urls/{url}',[ApiUrlController::class, 'destroy']);

});