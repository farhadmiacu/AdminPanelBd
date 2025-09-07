<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Farhad\BrandController;
use App\Http\Controllers\Backend\Farhad\StatusController;
use App\Http\Controllers\Backend\Farhad\ProductController;
use App\Http\Controllers\Backend\Farhad\CategoryController;
use App\Http\Controllers\Backend\Farhad\DashboardController;
use App\Http\Controllers\Backend\Farhad\SystemSettingController;

Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    // Brands routes
    Route::get('brands', [BrandController::class, 'index'])->name('brands.index');
    Route::get('brands/create', [BrandController::class, 'create'])->name('brands.create');
    Route::post('brands', [BrandController::class, 'store'])->name('brands.store');
    Route::get('brands/{brand}', [BrandController::class, 'show'])->name('brands.show');
    Route::get('brands/{brand}/edit', [BrandController::class, 'edit'])->name('brands.edit');
    Route::put('brands/{brand}', [BrandController::class, 'update'])->name('brands.update');
    Route::delete('brands/{brand}', [BrandController::class, 'destroy'])->name('brands.destroy');

    // Categories routes
    Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
    Route::get('categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    // Products routes
    Route::get('products', [ProductController::class, 'index'])->name('products.index');
    Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('products', [ProductController::class, 'store'])->name('products.store');
    Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

    // Systems routes
    Route::get('system/settings', [SystemSettingController::class, 'edit'])->name('system-settings.edit');
    Route::post('system/settings', [SystemSettingController::class, 'update'])->name('system-settings.update');

    //status
    Route::post('/update-status', [StatusController::class, 'update'])->name('status.update');
});
