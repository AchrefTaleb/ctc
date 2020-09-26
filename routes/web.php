<?php

use Illuminate\Support\Facades\Route;
use App\Mail\newUserMail;
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

Route::get('/default','DefaultController@roles');
Route::get('/', function () {
   // return view('under');
  return  redirect()->route('login');
});

//Route::get('/roles','DefaultController@roles');
Route::get('/home',  function () {
    // return view('under');
    return  redirect()->route('login');
})->name('home');

Route::get('/subs','HomeController@index');

Auth::routes();

Route::prefix('backoffice')->namespace('BackOffice')->middleware(['auth','backoffice'])->group(function(){
    Route::get('/','HomeController@index')->name('backoffice.home');

    Route::get('/staff','StaffController@list')->name('backoffice.staff.list');

    Route::get('/staff/create','StaffController@formCreate')->name('backoffice.staff.createform');
    Route::post('/staff/store','StaffController@create')->name('backoffice.staff.store');

    Route::get('/staff/update/{user}','StaffController@formupdate')->name('backoffice.staff.updateform');
    Route::post('/staff/update','StaffController@update')->name('backoffice.staff.update');

    Route::post('/staff/delete','StaffController@delete')->name('backoffice.staff.delete');

    /*
     *
     * Clients routes
     *
     */
    Route::get('/client','ClientController@list')->name('backoffice.client.list');

    Route::get('/client/create','ClientController@formCreate')->name('backoffice.client.createform');
    Route::post('/client/store','ClientController@create')->name('backoffice.client.store');

    Route::get('/client/update/{user}','ClientController@formupdate')->name('backoffice.client.updateform');
    Route::post('/client/update','ClientController@update')->name('backoffice.client.update');

    Route::post('/client/delete','ClientController@delete')->name('backoffice.client.delete');

    /*
     *
     * Categories routes
     *
     */
    Route::get('/categories','CategoryMailController@list')->name('backoffice.categorymail.list');
    Route::post('/categorie/store','CategoryMailController@create')->name('backoffice.categorymail.create');
    Route::post('/categorie/delete','CategoryMailController@delete')->name('backoffice.categorymail.delete');
    Route::post('/categorie/update','CategoryMailController@update')->name('backoffice.categorymail.update');

    /*
     *
     * Mails routes
     *
     */

    Route::get('/mail','MailController@list')->name('backoffice.mail.list');
    Route::get('/mail/{mail}/update','MailController@updateForm')->name('backoffice.mail.updateform');
    Route::get('/trash','MailController@trashList')->name('backoffice.mail.list.trash');
    Route::get('/archive','MailController@archiveList')->name('backoffice.mail.list.archive');
    Route::get('/mail/show/{mail}','MailController@show')->name('backoffice.mail.show');
    Route::get('mail/create','MailController@createForm')->name('backoffice.mail.createform');
    Route::post('mail/store','MailController@create')->name('backoffice.mail.store');
    Route::post('mail/items/store','MailController@itemsStore')->name('backoffice.mail.items.store');
    Route::post('mail/delete','MailController@delete')->name('backoffice.mail.delete');
    Route::post('mail/trash','MailController@trash')->name('backoffice.mail.trash');
    Route::post('mail/restore','MailController@restore')->name('backoffice.mail.restore');

    Route::post('mail/archive','MailController@archive')->name('backoffice.mail.archive');
    Route::post('mail/archive/restore','MailController@restore_archive')->name('backoffice.mail.restore_archive');

    Route::get('mail/request/list','MailController@requestList')->name('backoffice.mail.request.list');
    Route::get('mail/request/cancel/{request}','MailController@cancelRequest')->name('backoffice.mail.request.canceling');
    Route::post('mail/request/approve','MailController@approveRequest')->name('backoffice.mail.request.approve');
    Route::post('mail/request/sent','MailController@sentRequest')->name('backoffice.mail.request.sent');

    /*
     *
     *  Plans routes
     *
     */

    Route::get('/plan/list','PlanController@list')->name('backoffice.plan.list');
    Route::get('/plan/custom/create','PlanController@createCustomPlan')->name('backoffice.plan.custom.create');
    Route::post('/plan/custom/store','PlanController@storeCustomPlan')->name('backoffice.plan.custom.store');

    /*
     *
     *  Profile
     *
     */
    Route::get('profile','SettingsController@profile')->name('backoffice.profile');
    Route::post('password','SettingsController@password')->name('backoffice.password');

    /*
     *
     *  Promos
     *
     */
    Route::get('/promo/list','PromoController@list')->name('backoffice.promo.list');

});


Route::prefix('frontoffice')->namespace('FrontOffice')->middleware(['auth','frontoffice'])->group(function(){

    // subscription
    Route::get('subscription/create','SubscriptionController@index')->middleware('hassubscription')->name('frontoffice.subscription.create');
    Route::post('subscription/checkout','SubscriptionController@checkout')->middleware('hassubscription')->name('frontoffice.subscription.checkout');
    Route::post('subscription/charge','SubscriptionController@charge')->middleware('hassubscription')->name('frontoffice.subscription.charge');


    Route::middleware(['subscription'])->group(function (){
        // client area
        Route::get('/','HomeController@index')->name('frontoffice.home');

        /*
         *  Mails
         */
        Route::get('/mail','MailController@list')->name('frontoffice.mail.list');
        Route::get('/trash','MailController@trashList')->name('frontoffice.mail.list.trash');
        Route::get('/archive','MailController@archiveList')->name('frontoffice.mail.list.archive');

        Route::get('/mail/show/{mail}','MailController@show')->name('frontoffice.mail.show');
        Route::post('mail/delete','MailController@delete')->name('frontoffice.mail.delete');
        Route::post('mail/trash','MailController@trash')->name('frontoffice.mail.trash');
        Route::post('mail/restore','MailController@restore')->name('frontoffice.mail.restore');

        Route::post('mail/archive','MailController@archive')->name('frontoffice.mail.archive');
        Route::post('mail/restore/archive','MailController@restore_archive')->name('frontoffice.mail.restore_archive');
        Route::post('mail/request/send','MailController@requesting')->name('frontoffice.mail.request.send');
        Route::get('mail/request/add','MailController@requestAdd')->name('frontoffice.mail.request.add');
        Route::get('mail/request/list','MailController@requestList')->name('frontoffice.mail.request.list');
        Route::get('mail/request/cancel/{request}','MailController@cancelRequest')->name('frontoffice.mail.request.canceling');
        Route::get('mail/request/checkout/{request}','MailController@requestCheckout')->name('frontoffice.mail.request.checkout');
        Route::post('mail/request/paiement','MailController@requestPayement')->name('frontoffice.mail.request.paiement');

        Route::get('/my/subscription','SubscriptionController@user_plan')->name('frontoffice.my.subscription');


        Route::get('profile','SettingsController@profile')->name('frontoffice.profile');
        Route::post('profile/update','SettingsController@profileUpdate')->name('frontoffice.profile.update');
        Route::post('password','SettingsController@password')->name('frontoffice.password');

    });

});

Route::get('plans','BackOffice\PlanController@add_plans');
Route::get('/emails', function(){
    return new newUserMail();
});
