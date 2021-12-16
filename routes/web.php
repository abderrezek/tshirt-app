<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

require __DIR__.'/auth.php';

require __DIR__.'/sites.php';

require __DIR__.'/admin.php';

Route::fallback(function () {
    $request = request();
    if ($request->is('admin/*') && $request->user() && $request->user()->isAdmin()) {
        // return view('errors.admin.404');
        return Inertia::render('ErrorPage');
    }

    return view('errors.404');
});
