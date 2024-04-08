<?php

use App\Http\Controllers\Api\ServiceModelController;
use App\Http\Controllers\Api\VehicleMakeController;
use App\Http\Controllers\Api\VehicleModelController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. VehicleMake something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('makes/{make}/models', [VehicleModelController::class, 'index'])->name('makes.models.index');
Route::post('makes/{make}/models', [VehicleModelController::class, 'store'])->name('makes.models.store');

Route::post('makes/', [VehicleMakeController::class, 'store'])->name('makes.store');

Route::get('services', [ServiceModelController::class, 'index'])->name('services.index');
