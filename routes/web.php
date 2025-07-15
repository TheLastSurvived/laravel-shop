<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/', [ProductController::class, 'index'])->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');


Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart');
    Route::post('/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
    Route::put('/update/{product}', [CartController::class, 'update'])->name('cart.update');
});


Route::resource('products', ProductController::class);


Route::middleware('auth')->group(function () {
    // Для отображения формы (GET)
    Route::get('/account', [ProfileController::class, 'edit'])->name('profile.edit');

    // Для обработки обновления (PUT/PATCH)
    Route::put('/account', [ProfileController::class, 'update'])->name('profile.update');
});


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/registration', [RegisterController::class, 'showRegistrationForm'])->name('registration');
Route::post('/registration', [RegisterController::class, 'register']);


Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
