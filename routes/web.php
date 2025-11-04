<?php

use App\Http\Controllers\Managers\ManagerDashboardController;
use App\Http\Controllers\Managers\ManagerProductController;
use App\Http\Controllers\OrdersrController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


Route::get('/', [ProductController::class, 'show'])->name('product.show');
Route::get('/home', function() {
    return view('home');
});

Route::get('/api/products', [ProductController::class, 'getData'])->name('product.api');
Route::get('/api/reviews', [ProductController::class, 'getDataReviews'])->name('product.api.reviews');

Route::get('/manager/products', [ManagerProductController::class, 'view'])->name('manager.products.view');
Route::get('/manager', [ManagerDashboardController::class, 'view'])->name('manager.dashboard.view');

Route::post('/api/orders/prepare', [OrdersrController::class, 'prepare'])->name('orders.prepare');
