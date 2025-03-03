<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ToyCategoryController;
use App\Http\Controllers\ToyController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect('category');


});

Route::group(['prefix' => 'category'], function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::post('/create', [CategoryController::class, 'create']);
    Route::get('/delete/{id}', [CategoryController::class, 'delete']);
    Route::post('/update/{id}', [CategoryController::class, 'update']);
});
Route::group(['prefix' => 'store'], function () {
    Route::get('/', [StoreController::class, 'index']);
    Route::post('/create', [StoreController::class, 'create']);
    Route::get('/delete/{id}', [StoreController::class, 'delete']);
    Route::post('/update/{id}', [StoreController::class, 'update']);
});
Route::group(['prefix' => 'sponsor'], function () {
    Route::get('/', [SponsorController::class, 'index'])->name('index');
    Route::post('/create', [SponsorController::class, 'create'])->name('create');
    Route::get('/delete/{id}', [SponsorController::class, 'delete'])->name('delete');
    Route::post('/update/{id}', [SponsorController::class, 'update'])->name('update');
});
Route::group(['prefix' => 'toy'], function () {
    Route::get('/', [ToyController::class, 'index'])->name('index');
    Route::post('/create', [ToyController::class, 'create'])->name('create');
    Route::get('/delete/{id}', [ToyController::class, 'delete'])->name('delete');
    Route::put('/update/{id}', [ToyController::class, 'update']);
});
Route::group(['prefix' => 'brand'], function () {
    Route::get('/', [BrandController::class, 'index'])->name('index');
    Route::post('/create', [BrandController::class, 'create'])->name('create');
    Route::get('/delete/{id}', [BrandController::class, 'delete'])->name('delete');
    Route::post('/update/{id}', [BrandController::class, 'update'])->name('update');
});
Route::group(['prefix' => 'toycategory'], function () {
    Route::get('/', [ToyCategoryController::class, 'index'])->name('index');
    Route::post('/create', [ToyCategoryController::class, 'create'])->name('create');
    Route::get('/delete/{id}', [ToyCategoryController::class, 'delete'])->name('delete');
    Route::post('/update/{id}', [ToyCategoryController::class, 'update'])->name('update');
});