<?php

use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;


Route::controller(ProductsController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/products/create', 'create')->name('products.create');
    Route::post('/products/store', 'store')->name('products.store');
    Route::get('/products/{id}/edit', 'edit')->name('products.edit');
    Route::put('/products/{id}/update', 'update')->name('products.update');
    Route::delete('/products/{id}/destroy', 'destroy')->name('products.destroy');
});
