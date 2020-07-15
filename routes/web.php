<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/home', 'HomeController@index')->name('home');

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
    Route::get('/mail/show/{mail}','MailController@show')->name('backoffice.mail.show');
    Route::get('mail/create','MailController@createForm')->name('backoffice.mail.createform');
    Route::post('mail/store','MailController@create')->name('backoffice.mail.store');
    Route::post('mail/items/store','MailController@itemsStore')->name('backoffice.mail.items.store');
    Route::post('mail/delete','MailController@delete')->name('backoffice.mail.delete');
    Route::post('mail/trash','MailController@trash')->name('backoffice.mail.trash');
    Route::post('mail/restore','MailController@restore')->name('backoffice.mail.restore');

});


