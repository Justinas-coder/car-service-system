<?php

use App\Http\Controllers\AdminController;
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

    Route::get('/admin/vehicle-make', [VehicleMakeController::class, 'index'])->name('admin.vehicle-make.index');
    Route::get('/admin/vehicle-make/create', [VehicleMakeController::class, 'create'])->name('admin.vehicle-make.create');
    Route::post('/admin/vehicle-make/store', [VehicleMakeController::class, 'store'])->name('admin.vehicle-make.store');

    Route::get('/admin/vehicle-make/{vehicleMake}/models', [VehicleModelController::class, 'index'])->name('admin.vehicle-make.models.index');
    Route::get('/admin/vehicle-make/{vehicleMake}/models/create', [VehicleModelController::class, 'create'])->name('admin.vehicle-make.models.create');


    Route::get('/admin/service', [ServiceController::class, 'index'])->name('admin.service.index');

    Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');

});

require __DIR__.'/auth.php';
