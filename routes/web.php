<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CurrentOrdersController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\VehicleMakeController;
use App\Http\Controllers\VehicleModelController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. VehicleMake something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    Route::get('/vehicle', [VehicleMakeController::class, 'index'])->name('vehicles.index');
    Route::get('/vehicles/{vehicle}', [VehicleMakeController::class, 'show'])->name('vehicles.show');
    Route::get('/vehicles/{vehicleMake}/edit', [VehicleMakeController::class, 'edit'])->name('vehicles.edit');
    Route::delete('/vehicles/{make}', [VehicleMakeController::class, 'destroy'])->name('vehicles.destroy');
    Route::put('/vehicles/{make}', [VehicleMakeController::class, 'update'])->name('vehicles.update');

    Route::get('/vehicle-makes/vehicle-models/{vehicleModel}/edit', [VehicleModelController::class, 'edit'])->name('vehicle-models.edit');
    Route::put('/vehicle-makes/vehicle-models/{vehicleModel}', [VehicleModelController::class, 'update'])->name('vehicle-models.update');
    Route::delete('/vehicle-makes/vehicle-models/{vehicleModel}', [VehicleModelController::class, 'destroy'])->name('vehicleModels.destroy');

    Route::get('services/create', [ServiceController::class, 'create'])->name('services.create');
    Route::get('services/{service}', [ServiceController::class, 'show'])->name('services.show');
    Route::get('services/', [ServiceController::class, 'index'])->name('services.index');
    Route::post('services/', [ServiceController::class, 'store'])->name('services.store');
    Route::get('services/{service}/edit', [ServiceController::class, 'edit'])->name('services.edit');
    Route::delete('services/{service}', [ServiceController::class, 'destroy'])->name('services.destroy');
    Route::put('services/{service}', [ServiceController::class, 'update'])->name('services.update');

    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}/edit', [OrderController::class, 'edit'])->name('orders.edit');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::put('/orders/{order}', [OrderController::class, 'update'])->name('orders.update');
    Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');

});

require __DIR__.'/auth.php';
