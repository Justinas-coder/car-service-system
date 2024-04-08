<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CurrentOrdersController;
use App\Http\Controllers\InvoiceController;
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


    Route::get('/cart/{order}', [CartController::class, 'index'])->name('cart.index');
    Route::post('/checkout/{order}', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::get('/success', [CartController::class, 'success'])->name('cart.success');
    Route::get('/cancel', [CartController::class, 'cancel'])->name('cart.cancel');
    Route::post('/webhook', [CartController::class, 'webhook'])->name('cart.webhook');

    Route::resource('vehicles', VehicleMakeController::class)->except(['store']);

    Route::resource('models', VehicleModelController::class)->only(['edit', 'update', 'destroy']);

    Route::resource('services', ServiceController::class);

    Route::resource('orders', OrderController::class);

Route::get('/{order}/invoice-send', [InvoiceController::class, 'sendInvoiceEmail'])->name('invoice.invoice-send');

});

require __DIR__.'/auth.php';
