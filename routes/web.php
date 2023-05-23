<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/admin', function () {
//     return view('layouts/admin');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth','admin'], 'prefix' => 'admin'], function() {
    Route::get('/dashboard', function () {
        return view('layouts/admin');
    });
});

Route::group(['middleware' => ['auth'], 'prefix' => 'user'], function() {
    Route::get('/dashboard', function () {
        return view('home');
    });
});
