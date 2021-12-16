<?php

use App\Http\Controllers\AdminLinksController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ClotheController;
use App\Http\Controllers\CouponsController;
use App\Http\Controllers\MarqueController;
use Illuminate\Support\Facades\Route;

Route::name('admin.')->prefix('/admin')->middleware(['auth', 'admin'])->group(function () {

    Route::get('/', [AdminLinksController::class, 'index'])->name('index');

    // Clothes routes
    Route::name('clothes.')->prefix('/clothes')->group(function () {
        Route::get('/', [ClotheController::class, 'index'])->name('index');
        Route::get('/create', [ClotheController::class, 'create'])->name('create');
        Route::post('/create', [ClotheController::class, 'store'])->name('store');
        Route::get('/edit/{clothe:id}', [ClotheController::class, 'edit'])->where('id', '[0-9]+')->name('edit');
        Route::post('/edit', [ClotheController::class, 'update'])->name('update');
        Route::delete('/{clothe:id}', [ClotheController::class, 'destroy'])->where('id', '[0-9]+')->name('delete');
    });

    // Marques routes
    Route::name('marques.')->prefix('/marques')->group(function () {
        Route::get('/', [MarqueController::class, 'index'])->name('index');
        Route::post('/create', [MarqueController::class, 'store'])->name('store');
        Route::post('/edit', [MarqueController::class, 'update'])->name('update');
        Route::delete('/{marque:id}', [MarqueController::class, 'destroy'])->where('id', '[0-9]+')->name('delete');
    });

    // Coupons routes
    Route::name('coupons.')->prefix('/coupons')->group(function () {
        Route::get('/', [CouponsController::class, 'index'])->name('index');
        Route::post('/create', [CouponsController::class, 'store'])->name('store');
        Route::post('/edit', [CouponsController::class, 'update'])->name('update');
        Route::delete('/{code}', [CouponsController::class, 'destroy'])->name('delete');
        Route::delete('/', [CouponsController::class, 'destroyAll'])->name('deleteAll');
    });
});
