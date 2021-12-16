<?php

use App\Http\Controllers\LinksController;
use Illuminate\Support\Facades\Route;


Route::name('site.')->group(function () {

    Route::get('/', [LinksController::class, 'boutique'])->name('boutique');
    Route::get('/clothe/{slug}', [LinksController::class, 'clothe'])->name('clothe');

    Route::get('/a-propos', [LinksController::class, 'aPropos'])->name('a-propos');

    Route::get('/ou-acheter', [LinksController::class, 'ouAcheter'])->name('ou-acheter');

    Route::get('/faq', [LinksController::class, 'faq'])->name('faq');

    Route::get('/contact', [LinksController::class, 'contact'])->name('contact');

    Route::get('/panier', [LinksController::class, 'panier'])->name('panier');

    Route::get('/profil', [LinksController::class, 'profil'])->middleware('auth')->name('profil');

    Route::get('/profil/adresse', [LinksController::class, 'address'])->middleware('auth')->name('address');

    Route::get('/checkout', [LinksController::class, 'checkout'])->middleware('auth')->name('checkout');
});