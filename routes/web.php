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
    //Admin Dashboard
    Route::get('/dashboard', function () { return view('admin.welcome'); });

    //Parishioners
    Route::get('/parishioners', [App\Http\Controllers\ParishionerController::class, 'index'])->name('parishionerlist');

    //Documents
    Route::get('/documents', function(){ return 'hello'; })->name('documentlist');

    //Document Requests
    Route::get('/documentrequests', [App\Http\Controllers\DocumentRequestController::class, 'index'])->name('admindocumentrequestlist');

    //Payments
    Route::get('/payments', [App\Http\Controllers\PaymentController::class, 'index'])->name('paymentlist');
    Route::post('/payments-verify/{payment}', [App\Http\Controllers\PaymentController::class, 'verify'])->name('paymentverify');

});

Route::group(['middleware' => ['auth'], 'prefix' => 'user'], function() {
    Route::get('/dashboard', function () {
        return view('home');
    })->name('user-dashboard');

    //profile
    Route::get('/profile', [App\Http\Controllers\UserController::class, 'show'])->name('userprofile');
    Route::post('/profileupdate', [App\Http\Controllers\UserController::class, 'update'])->name('userprofileupdate');

    //document request
    Route::get('/documentrequest', [App\Http\Controllers\DocumentRequestController::class, 'index'])->name('documentrequest');
    Route::post('/documentrequestsave', [App\Http\Controllers\DocumentRequestController::class, 'store'])->name('documentrequestsave');
    Route::post('/documentrequestcancel', [App\Http\Controllers\DocumentRequestController::class, 'cancel'])->name('documentrequestcancel');
});
