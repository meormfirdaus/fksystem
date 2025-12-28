<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AvailabilityApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*
|--------------------------------------------------------------------------
| API ROUTES
|--------------------------------------------------------------------------
| These routes are stateless and return JSON responses
*/

Route::get('/availability', [AvailabilityApiController::class, 'availability']);

Route::get('/parking-space/{token}', [AvailabilityApiController::class, 'parkingSpace']);