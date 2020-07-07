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
});


