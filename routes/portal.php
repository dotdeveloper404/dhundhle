<?php

use App\Http\Controllers\Portal\HotelController;
use App\Http\Controllers\portal\ProductController;
use App\Http\Controllers\Portal\CategoryController;
use App\Http\Controllers\Portal\InvoiceController;
use App\Http\Controllers\Portal\ShopController;
use Illuminate\Support\Facades\Route;


Route::resource('category',CategoryController::class);
Route::resource('product',ProductController::class);
Route::resource('shop',ShopController::class);
Route::resource('invoice',InvoiceController::class);


Route::get('/', [App\Http\Controllers\Portal\HomeController::class, 'index'])->name('home');
