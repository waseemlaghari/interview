<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PassengerController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\TransferController;

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

Route::resource('/passenger', PassengerController::class);
Route::resource('/addpassenger', PassengerController::class);
//Route::resource('/editpassenger/{id}', PassengerController::class);

Route::resource('/vehicle', VehicleController::class);
Route::resource('/addvehicle', VehicleController::class);


Route::resource('/transfer', TransferController::class);
Route::resource('/addtransfer', TransferController::class);

