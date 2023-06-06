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

Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index']);

// Route::get('/admin', function () {
//     return view('layouts/admin');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/events', [App\Http\Controllers\EventController::class, 'index'])->name('eventlist');
Route::get('/events/{event}', [App\Http\Controllers\EventController::class, 'show'])->name('eventshow');

Route::group(['middleware' => ['auth','admin'], 'prefix' => 'admin'], function() {
    //Admin Dashboard
    Route::get('/dashboard', function () { return view('admin.welcome'); });

    //Events
    Route::get('/events-list', [App\Http\Controllers\EventController::class, 'adminindex'])->name('admin-eventlist');
    Route::post('/events', [App\Http\Controllers\EventController::class, 'store'])->name('eventsave');
    Route::get('/events-list/{event}', [App\Http\Controllers\EventController::class, 'adminshow'])->name('admin-eventshow');

    //Clients
    Route::get('/clients', [App\Http\Controllers\ClientController::class, 'index'])->name('clientlist');

    //Documents
    Route::get('/documents', [App\Http\Controllers\DocumentController::class, 'index'])->name('documentlist');
    Route::post('/documents', [App\Http\Controllers\DocumentController::class, 'store'])->name('documentsave');

    
    ### DOCUMENT REQUEST ###
    Route::get('/documentrequests', [App\Http\Controllers\DocumentRequest\DocumentRequestBaptismController::class, 'index'])->name('documentrequestlist');

    // Baptism Doc Request
    Route::get('/documentrequestbaptisms', [App\Http\Controllers\DocumentRequest\DocumentRequestBaptismController::class, 'index'])->name('documentrequestbaptismlist');
    Route::post('/documentrequestbaptisms-setready', [App\Http\Controllers\DocumentRequest\DocumentRequestBaptismController::class, 'setReady'])->name('documentrequestbaptismsetready');

    // Confirmation Doc Request
    Route::get('/documentrequestconfirmations', [App\Http\Controllers\DocumentRequest\DocumentRequestConfirmationController::class, 'index'])->name('documentrequestconfirmationlist');
    Route::post('/documentrequestconfirmations-setready', [App\Http\Controllers\DocumentRequest\DocumentRequestConfirmationController::class, 'setReady'])->name('documentrequestconfirmationsetready');

    // Communion Doc Request
    Route::get('/documentrequestcommunions', [App\Http\Controllers\DocumentRequest\DocumentRequestCommunionController::class, 'index'])->name('documentrequestcommunionlist');
    Route::post('/documentrequestcommunions-setready', [App\Http\Controllers\DocumentRequest\DocumentRequestCommunionController::class, 'setReady'])->name('documentrequestcommunionsetready');
    
    // Matrimony Doc Request
    Route::get('/documentrequestmatrimonies', [App\Http\Controllers\DocumentRequest\DocumentRequestMatrimonyController::class, 'index'])->name('documentrequestmatrimonylist');
    Route::post('/documentrequestmatrimonies-setready', [App\Http\Controllers\DocumentRequest\DocumentRequestMatrimonyController::class, 'setReady'])->name('documentrequestmatrimonysetready');


    // Blessing Doc Request
    Route::get('/documentrequestblessing', [App\Http\Controllers\DocumentRequest\DocumentRequestBlessingController::class, 'index'])->name('documentrequestblessinglist');
    Route::post('/documentrequestblessing-setready', [App\Http\Controllers\DocumentRequest\DocumentRequestBlessingController::class, 'setReady'])->name('documentrequestblessingsetready');

    // Death Doc Request
    Route::get('/documentrequestdeath', [App\Http\Controllers\DocumentRequest\DocumentRequestDeathController::class, 'index'])->name('documentrequestdeathlist');
    Route::post('/documentrequestdeath-setready', [App\Http\Controllers\DocumentRequest\DocumentRequestDeathController::class, 'setReady'])->name('documentrequestdeathsetready');


    ### EVENT RESERVATION ###
    Route::get('/eventreservations', [App\Http\Controllers\EventReservationController::class, 'index'])->name('eventreservationlist');

    //Baptism
    Route::get('/baptisms', [App\Http\Controllers\Reservation\BaptismController::class, 'index'])->name('baptismlist');
    Route::post('/baptismaccept', [App\Http\Controllers\Reservation\BaptismController::class, 'acceptreservation'])->name('baptismaccept');
    Route::post('/baptismreject', [App\Http\Controllers\Reservation\BaptismController::class, 'rejectreservation'])->name('baptismreject');

    //Communion
    Route::get('/communions', [App\Http\Controllers\Reservation\CommunionController::class, 'index'])->name('communionlist');
    Route::post('/communionaccept', [App\Http\Controllers\Reservation\CommunionController::class, 'acceptreservation'])->name('communionaccept');
    Route::post('/communionreject', [App\Http\Controllers\Reservation\CommunionController::class, 'rejectreservation'])->name('communionreject');

    //Confirmation
    Route::get('/confirmations', [App\Http\Controllers\Reservation\ConfirmationController::class, 'index'])->name('confirmationlist');
    Route::post('/confirmationaccept', [App\Http\Controllers\Reservation\ConfirmationController::class, 'acceptreservation'])->name('confirmationaccept');
    Route::post('/confirmationreject', [App\Http\Controllers\Reservation\ConfirmationController::class, 'rejectreservation'])->name('confirmationreject');

    //Confirmation
    Route::get('/matrimonies', [App\Http\Controllers\Reservation\MatrimonyController::class, 'index'])->name('matrimonylist');
    Route::post('/matrimonyaccept', [App\Http\Controllers\Reservation\MatrimonyController::class, 'acceptreservation'])->name('matrimonyaccept');
    Route::post('/matrimonyreject', [App\Http\Controllers\Reservation\MatrimonyController::class, 'rejectreservation'])->name('matrimonyreject');

    //Blessing
    Route::get('/blessings', [App\Http\Controllers\Reservation\BlessingController::class, 'index'])->name('blessinglist');
    Route::post('/blessingaccept', [App\Http\Controllers\Reservation\BlessingController::class, 'acceptreservation'])->name('blessingaccept');
    Route::post('/blessingreject', [App\Http\Controllers\Reservation\BlessingController::class, 'rejectreservation'])->name('blessingreject');

    //Funeral
    Route::get('/funerals', [App\Http\Controllers\Reservation\FuneralController::class, 'index'])->name('funerallist');
    Route::post('/funeralaccept', [App\Http\Controllers\Reservation\FuneralController::class, 'acceptreservation'])->name('funeralaccept');
    Route::post('/funeralreject', [App\Http\Controllers\Reservation\FuneralController::class, 'rejectreservation'])->name('funeralreject');


    ### REPORT ###
    Route::group(['prefix' => 'reports'], function() {
        Route::any('/clients', [App\Http\Controllers\Report\ClientReportController::class, 'index'])->name('report-clientlist');
        Route::any('/documents', [App\Http\Controllers\Report\DocumentReportController::class, 'index'])->name('report-documentlist');

        Route::any('/event-reservation', [App\Http\Controllers\Report\EventReservation\BaptismEventReportController::class, 'index'])->name('report-eventreservationlist');
        Route::any('/event-reservation/baptisms', [App\Http\Controllers\Report\EventReservation\BaptismEventReportController::class, 'index'])->name('report-baptismlist');
        Route::any('/event-reservation/confirmations', [App\Http\Controllers\Report\EventReservation\ConfirmationEventReportController::class, 'index'])->name('report-confirmationlist');
        Route::any('/event-reservation/communions', [App\Http\Controllers\Report\EventReservation\CommunionEventReportController::class, 'index'])->name('report-communionlist');
        Route::any('/event-reservation/matrimonies', [App\Http\Controllers\Report\EventReservation\MatrimonyEventReportController::class, 'index'])->name('report-matrimonylist');
        Route::any('/event-reservation/blessings', [App\Http\Controllers\Report\EventReservation\BlessingEventReportController::class, 'index'])->name('report-blessinglist');
        Route::any('/event-reservation/funerals', [App\Http\Controllers\Report\EventReservation\FuneralEventReportController::class, 'index'])->name('report-funerallist');

        Route::any('/document-request', [App\Http\Controllers\Report\DocumentRequest\BaptismDocumentRequestReportController::class, 'index'])->name('report-docrequest');
        Route::any('/document-request/baptisms', [App\Http\Controllers\Report\DocumentRequest\BaptismDocumentRequestReportController::class, 'index'])->name('report-docrequest-baptism');
        Route::any('/document-request/confirmations', [App\Http\Controllers\Report\DocumentRequest\ConfirmationDocumentRequestReportController::class, 'index'])->name('report-docrequest-confirmation');
        Route::any('/document-request/communions', [App\Http\Controllers\Report\DocumentRequest\CommunionDocumentRequestReportController::class, 'index'])->name('report-docrequest-communion');
        Route::any('/document-request/matrimonies', [App\Http\Controllers\Report\DocumentRequest\MatrimonyDocumentRequestReportController::class, 'index'])->name('report-docrequest-matrimony');
        Route::any('/document-request/blessings', [App\Http\Controllers\Report\DocumentRequest\BlessingDocumentRequestReportController::class, 'index'])->name('report-docrequest-blessing');
        Route::any('/document-request/deaths', [App\Http\Controllers\Report\DocumentRequest\DeathDocumentRequestReportController::class, 'index'])->name('report-docrequest-death');

    });

});

Route::group(['middleware' => ['auth'], 'prefix' => 'user'], function() {
    Route::get('/dashboard', function () {
        return view('home');
    })->name('user-dashboard');

    //profile
    Route::get('/profile', [App\Http\Controllers\UserController::class, 'show'])->name('userprofile');
    Route::post('/profileupdate', [App\Http\Controllers\UserController::class, 'update'])->name('userprofileupdate');

    //notification
    Route::get('/notifications', [App\Http\Controllers\NotificationController::class, 'index'])->name('usernotification');

    //reservation
    Route::get('/reservations', [App\Http\Controllers\ClientController::class, 'reservation'])->name('clientreservations');

    //baptism
    Route::get('/baptisms', [App\Http\Controllers\Reservation\BaptismController::class, 'index'])->name('clientbaptism');
    Route::post('/baptisms', [App\Http\Controllers\Reservation\BaptismController::class, 'store'])->name('clientbaptismsave');

    //communion
    Route::get('/communions', [App\Http\Controllers\Reservation\CommunionController::class, 'index'])->name('clientcommunion');
    Route::post('/communions', [App\Http\Controllers\Reservation\CommunionController::class, 'store'])->name('clientcommunionsave');

    //confirmation
    Route::get('/confirmations', [App\Http\Controllers\Reservation\ConfirmationController::class, 'index'])->name('clientconfirmation');
    Route::post('/confirmations', [App\Http\Controllers\Reservation\ConfirmationController::class, 'store'])->name('clientconfirmationsave');

    //matrimony
    Route::get('/matrimonies', [App\Http\Controllers\Reservation\MatrimonyController::class, 'index'])->name('clientmatrimony');
    Route::post('/matrimonies', [App\Http\Controllers\Reservation\MatrimonyController::class, 'store'])->name('clientmatrimonysave');

    //blessing
    Route::get('/blessings', [App\Http\Controllers\Reservation\BlessingController::class, 'index'])->name('clientblessing');
    Route::post('/blessings', [App\Http\Controllers\Reservation\BlessingController::class, 'store'])->name('clientblessingsave');

    //funeral
    Route::get('/funerals', [App\Http\Controllers\Reservation\FuneralController::class, 'index'])->name('clientfuneral');
    Route::post('/funerals', [App\Http\Controllers\Reservation\FuneralController::class, 'store'])->name('clientfuneralsave');


    //document request
    Route::get('/documentrequest', [App\Http\Controllers\DocumentRequest\DocumentRequestBaptismController::class, 'index'])->name('client-documentrequestlist');

    // Route::post('/documentrequestsave', [App\Http\Controllers\DocumentRequestController::class, 'store'])->name('documentrequestsave');
    // Route::post('/documentrequestcancel', [App\Http\Controllers\DocumentRequestController::class, 'cancel'])->name('documentrequestcancel');
    
    // Baptism Document Request
    Route::get('/documentrequestbaptisms', [App\Http\Controllers\DocumentRequest\DocumentRequestBaptismController::class, 'index'])->name('client-documentrequestbaptismlist');
    Route::post('/documentrequestbaptisms', [App\Http\Controllers\DocumentRequest\DocumentRequestBaptismController::class, 'store'])->name('client-documentrequestbaptismsave');
    Route::post('/canceldocumentrequestbaptism', [App\Http\Controllers\DocumentRequest\DocumentRequestBaptismController::class, 'cancel'])->name('client-canceldocumentrequestbaptism');

    //Confirmation Document Request
    Route::get('/documentrequestconfirmations', [App\Http\Controllers\DocumentRequest\DocumentRequestConfirmationController::class, 'index'])->name('client-documentrequestconfirmationlist');
    Route::post('/documentrequestconfirmations', [App\Http\Controllers\DocumentRequest\DocumentRequestConfirmationController::class, 'store'])->name('client-documentrequestconfirmationsave');
    Route::post('/canceldocumentrequestconfirmation', [App\Http\Controllers\DocumentRequest\DocumentRequestConfirmationController::class, 'cancel'])->name('client-canceldocumentrequestconfirmation');

    //Communion Document Request
    Route::get('/documentrequestcommunions', [App\Http\Controllers\DocumentRequest\DocumentRequestCommunionController::class, 'index'])->name('client-documentrequestcommunionlist');
    Route::post('/documentrequestcommunions', [App\Http\Controllers\DocumentRequest\DocumentRequestCommunionController::class, 'store'])->name('client-documentrequestcommunionsave');
    Route::post('/canceldocumentrequestcommunion', [App\Http\Controllers\DocumentRequest\DocumentRequestCommunionController::class, 'cancel'])->name('client-canceldocumentrequestcommunion');

    //Matrimony Document Request
    Route::get('/documentrequestmatrimonies', [App\Http\Controllers\DocumentRequest\DocumentRequestMatrimonyController::class, 'index'])->name('client-documentrequestmatrimonylist');
    Route::post('/documentrequestmatrimonies', [App\Http\Controllers\DocumentRequest\DocumentRequestMatrimonyController::class, 'store'])->name('client-documentrequestmatrimonysave');
    Route::post('/canceldocumentrequestmatrimony', [App\Http\Controllers\DocumentRequest\DocumentRequestMatrimonyController::class, 'cancel'])->name('client-canceldocumentrequestmatrimony');

    //Blessing Document Request
    Route::get('/documentrequestblessing', [App\Http\Controllers\DocumentRequest\DocumentRequestBlessingController::class, 'index'])->name('client-documentrequestblessinglist');
    Route::post('/documentrequestblessing', [App\Http\Controllers\DocumentRequest\DocumentRequestBlessingController::class, 'store'])->name('client-documentrequestblessingsave');
    Route::post('/canceldocumentrequestblessing', [App\Http\Controllers\DocumentRequest\DocumentRequestBlessingController::class, 'cancel'])->name('client-canceldocumentrequestblessing');

    //Death Document Request
    Route::get('/documentrequestdeath', [App\Http\Controllers\DocumentRequest\DocumentRequestDeathController::class, 'index'])->name('client-documentrequestdeathlist');
    Route::post('/documentrequestdeath', [App\Http\Controllers\DocumentRequest\DocumentRequestDeathController::class, 'store'])->name('client-documentrequestdeathsave');
    Route::post('/canceldocumentrequestdeath', [App\Http\Controllers\DocumentRequest\DocumentRequestDeathController::class, 'cancel'])->name('client-canceldocumentrequestdeath');


});
