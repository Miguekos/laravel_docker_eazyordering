<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Users;
use App\Http\Livewire\Product;
use App\Http\Livewire\Order;
use App\Http\Livewire\Category;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\ProductList;
use App\Http\Livewire\Details;
use App\Http\Livewire\Cart;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

// Locale
Route::get('/locale/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'es', 'it'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
});


// panel
Route::middleware(['web', 'auth:sanctum', 'verified'])->group(function () {
 
    Route::get('dashboard', Dashboard::class)->name('dashboard');

    Route::get('user', Users::class)->name('user');

    Route::get('order', Order::class)->name('order');

    Route::get('order-export/{order_id}', [OrderController::class, 'exportExcel'])->name('order.export');

    Route::get('product', Product::class)->name('product');

    Route::get('cart', Cart::class)->name('cart');

    Route::get('category/{warehouse_id}', Category::class)->name('category');

    Route::get('product-list/{warehouse_id}/{category}', ProductList::class)->name('product-list');

    Route::get('details/{product_id}', Details::class)->name('details');
    
    //Route::get('cart', [CartController::class, 'cartList'])->name('cart.list');

    Route::post('cart', [CartController::class, 'addToCart'])->name('cart.store');

    Route::post('update-cart', [CartController::class, 'updateCart'])->name('cart.update');

    Route::post('remove', [CartController::class, 'removeCart'])->name('cart.remove');
    
    Route::post('clear', [CartController::class, 'clearAllCart'])->name('cart.clear');

    Route::post('order-store', [OrderController::class, 'store'])->name('order.store');

    Route::get('order-show/{order_id}', [OrderController::class, 'show'])->name('order.show');

});

