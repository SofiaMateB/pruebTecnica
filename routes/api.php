<?php

use App\Http\Controllers\Api\VehicleAvailabilityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/vehicles/available', [VehicleAvailabilityController::class, 'available']);
Route::post('/vehicles/{id}/reserve', [VehicleAvailabilityController::class, 'reserve']);
Route::get('/vehicles/{id}/recommended-rate', [VehicleAvailabilityController::class, 'recommendedRate']);
Route::get('/vehicles/{id}/recommended-rate', [VehicleAvailabilityController::class, 'recommendedRate']);
Route::get('/vehicles/suggest-alternative', [VehicleAvailabilityController::class, 'suggestAlternativeVehicle']);
