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

    Route::get('/admin/vehicle-makes', [VehicleMakeController::class, 'index'])->name('admin.vehicle-makes.index');
    Route::get('/admin/vehicle-makes/create', [VehicleMakeController::class, 'create'])->name('admin.vehicle-makes.create');
    Route::get('/admin/vehicle-makes/{make}/edit', [VehicleMakeController::class, 'edit'])->name('admin.vehicle-makes.edit');
    Route::put('/admin/vehicle-makes/{make}', [VehicleMakeController::class, 'update'])->name('admin.vehicle-makes.update');
    Route::post('/admin/vehicle-makes', [VehicleMakeController::class, 'store'])->name('admin.vehicle-makes.store');
    Route::delete('/admin/vehicle-makes/{make}', [VehicleMakeController::class, 'destroy'])->name('admin.vehicle-makes.destroy');


    Route::get('/admin/vehicle-makes/{vehicleMake}/models', [VehicleModelController::class, 'index'])->name('admin.vehicle-makes.models.index');
    Route::get('/admin/vehicle-makes/{vehicleMake}/models/create', [VehicleModelController::class, 'create'])->name('admin.vehicle-makes.models.create');
    Route::post('/admin/vehicle-makes/{vehicleMake}/models', [VehicleModelController::class, 'store'])->name('admin.vehicle-makes.models.store');
    Route::get('/admin/vehicle-makes/models/{model}/edit', [VehicleModelController::class, 'edit'])->name('admin.vehicle-makes.models.edit');
    Route::delete('/admin/vehicle-makes/models/{vehicleModel}', [VehicleModelController::class, 'destroy'])->name('admin.vehicle-makes.models.destroy');
    Route::put('/admin/vehicle-makes/models/{vehicleModel}', [VehicleModelController::class, 'update'])->name('admin.vehicle-makes.models.update');


    Route::get('/admin/services', [ServiceController::class, 'index'])->name('admin.services.index');
    Route::get('/admin/services/create', [ServiceController::class, 'create'])->name('admin.services.create');
    Route::get('/admin/services/{service}/edit', [ServiceController::class, 'edit'])->name('admin.services.edit');
    Route::post('/admin/services', [ServiceController::class, 'store'])->name('admin.services.store');
    Route::put('/admin/services/{service}', [ServiceController::class, 'update'])->name('admin.services.update');
    Route::delete('/admin/services/{service}', [ServiceController::class, 'destroy'])->name('admin.services.destroy');


    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');

    Route::get('/orders/{order}', [CurrentOrdersController::class, 'index'])->name('current.orders.index');
    Route::put('/orders/{order}', [CurrentOrdersController::class, 'store'])->name('current.orders.store');
    Route::get('/orders/{order}/edit', [CurrentOrdersController::class, 'edit'])->name('current.orders.edit');

});

require __DIR__.'/auth.php';
