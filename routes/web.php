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

    //Clients
    Route::get('/clients', [App\Http\Controllers\ClientController::class, 'index'])->name('clientlist');

    //Documents
    Route::get('/documents', [App\Http\Controllers\DocumentController::class, 'index'])->name('documentlist');
    Route::post('/documents', [App\Http\Controllers\DocumentController::class, 'store'])->name('documentsave');

    
    ### DOCUMENT REQUEST ###
    Route::get('/documentrequests', [App\Http\Controllers\DocumentRequest\DocumentRequestBaptismController::class, 'index'])->name('documentrequestlist');

    // Route::get('/documentrequests', [App\Http\Controllers\DocumentRequestController::class, 'index'])->name('documentrequestlist');
    // Route::post('/documentrequests', [App\Http\Controllers\DocumentRequestController::class, 'setReady'])->name('documentrequestready');

    Route::get('/documentrequestbaptisms', [App\Http\Controllers\DocumentRequest\DocumentRequestBaptismController::class, 'index'])->name('documentrequestbaptismlist');
    Route::post('/documentrequestbaptisms-setready', [App\Http\Controllers\DocumentRequest\DocumentRequestBaptismController::class, 'setReady'])->name('documentrequestbaptismsetready');




    ### EVENT RESERVATION ###
    Route::get('/eventreservations', [App\Http\Controllers\EventReservationController::class, 'index'])->name('eventreservationlist');

    //Baptism
    Route::get('/baptisms', [App\Http\Controllers\BaptismController::class, 'index'])->name('baptismlist');
    Route::post('/baptismaccept', [App\Http\Controllers\BaptismController::class, 'acceptreservation'])->name('baptismaccept');
    Route::post('/baptismreject', [App\Http\Controllers\BaptismController::class, 'rejectreservation'])->name('baptismreject');

    //Communion
    Route::get('/communions', [App\Http\Controllers\CommunionController::class, 'index'])->name('communionlist');
    Route::post('/communionaccept', [App\Http\Controllers\CommunionController::class, 'acceptreservation'])->name('communionaccept');
    Route::post('/communionreject', [App\Http\Controllers\CommunionController::class, 'rejectreservation'])->name('communionreject');

    //Confirmation
    Route::get('/confirmations', [App\Http\Controllers\ConfirmationController::class, 'index'])->name('confirmationlist');
    Route::post('/confirmationaccept', [App\Http\Controllers\ConfirmationController::class, 'acceptreservation'])->name('confirmationaccept');
    Route::post('/confirmationreject', [App\Http\Controllers\ConfirmationController::class, 'rejectreservation'])->name('confirmationreject');

    //Confirmation
    Route::get('/matrimonies', [App\Http\Controllers\MatrimonyController::class, 'index'])->name('matrimonylist');
    Route::post('/matrimonyaccept', [App\Http\Controllers\MatrimonyController::class, 'acceptreservation'])->name('matrimonyaccept');
    Route::post('/matrimonyreject', [App\Http\Controllers\MatrimonyController::class, 'rejectreservation'])->name('matrimonyreject');

    //Blessing
    Route::get('/blessings', [App\Http\Controllers\BlessingController::class, 'index'])->name('blessinglist');
    Route::post('/blessingaccept', [App\Http\Controllers\BlessingController::class, 'acceptreservation'])->name('blessingaccept');
    Route::post('/blessingreject', [App\Http\Controllers\BlessingController::class, 'rejectreservation'])->name('blessingreject');

    //Blessing
    Route::get('/funerals', [App\Http\Controllers\FuneralController::class, 'index'])->name('funerallist');
    Route::post('/funeralaccept', [App\Http\Controllers\FuneralController::class, 'acceptreservation'])->name('funeralaccept');
    Route::post('/funeralreject', [App\Http\Controllers\FuneralController::class, 'rejectreservation'])->name('funeralreject');

});

Route::group(['middleware' => ['auth'], 'prefix' => 'user'], function() {
    Route::get('/dashboard', function () {
        return view('home');
    })->name('user-dashboard');

    //profile
    Route::get('/profile', [App\Http\Controllers\UserController::class, 'show'])->name('userprofile');
    Route::post('/profileupdate', [App\Http\Controllers\UserController::class, 'update'])->name('userprofileupdate');

    //reservation
    Route::get('/reservations', [App\Http\Controllers\ClientController::class, 'reservation'])->name('clientreservations');

    //baptism
    Route::get('/baptisms', [App\Http\Controllers\BaptismController::class, 'index'])->name('clientbaptism');
    Route::post('/baptisms', [App\Http\Controllers\BaptismController::class, 'store'])->name('clientbaptismsave');

    //communion
    Route::get('/communions', [App\Http\Controllers\CommunionController::class, 'index'])->name('clientcommunion');
    Route::post('/communions', [App\Http\Controllers\CommunionController::class, 'store'])->name('clientcommunionsave');

    //confirmation
    Route::get('/confirmations', [App\Http\Controllers\ConfirmationController::class, 'index'])->name('clientconfirmation');
    Route::post('/confirmations', [App\Http\Controllers\ConfirmationController::class, 'store'])->name('clientconfirmationsave');

    //matrimony
    Route::get('/matrimonies', [App\Http\Controllers\MatrimonyController::class, 'index'])->name('clientmatrimony');
    Route::post('/matrimonies', [App\Http\Controllers\MatrimonyController::class, 'store'])->name('clientmatrimonysave');

    //blessing
    Route::get('/blessings', [App\Http\Controllers\BlessingController::class, 'index'])->name('clientblessing');
    Route::post('/blessings', [App\Http\Controllers\BlessingController::class, 'store'])->name('clientblessingsave');

    //blessing
    Route::get('/funerals', [App\Http\Controllers\FuneralController::class, 'index'])->name('clientfuneral');
    Route::post('/funerals', [App\Http\Controllers\FuneralController::class, 'store'])->name('clientfuneralsave');


    //document request
    Route::get('/documentrequest', [App\Http\Controllers\DocumentRequest\DocumentRequestBaptismController::class, 'index'])->name('client-documentrequestlist');

    // Route::post('/documentrequestsave', [App\Http\Controllers\DocumentRequestController::class, 'store'])->name('documentrequestsave');
    // Route::post('/documentrequestcancel', [App\Http\Controllers\DocumentRequestController::class, 'cancel'])->name('documentrequestcancel');

    Route::get('/documentrequestbaptisms', [App\Http\Controllers\DocumentRequest\DocumentRequestBaptismController::class, 'index'])->name('client-documentrequestbaptismlist');
    Route::post('/documentrequestbaptisms', [App\Http\Controllers\DocumentRequest\DocumentRequestBaptismController::class, 'store'])->name('client-documentrequestbaptismsave');
});
