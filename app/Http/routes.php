<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', 'PagesController@index');

Route::get('doctors/search', 'DoctorsController@prepareSearchResults');
Route::get('doctors/details/{friendly_url}', 'DoctorsController@details');
Route::get('doctors/{specialty?}/{location?}', 'DoctorsController@index');
Route::post('doctors/filter', 'DoctorsController@filterResults');
Route::resource('doctors', 'DoctorsController');

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});
