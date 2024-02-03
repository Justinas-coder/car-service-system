<?php

use App\Http\Controllers\Api\ServiceController;
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
Route::get('services/{service}', [ServiceController::class, 'show'])->name('services.show');
