<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParkingController;

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

Route::get('/houses', [ParkingController::class, 'getHouses']);
Route::get('/free-parking', [ParkingController::class, 'getFreeParkingSpots']);
Route::post('/book-parking', [ParkingController::class, 'bookParkingSpot']);
Route::get('/rooms', [ParkingController::class, 'getRooms']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
