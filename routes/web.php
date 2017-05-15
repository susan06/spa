<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'FrontendController@index')->name('index');

Route::get('/local/search', 'FrontendController@localSearch')->name('local.search');

Route::get('/faqs', 'FrontendController@faqs')->name('faqs');

Route::get('/conditions', 'FrontendController@conditions')->name('conditions');

Route::get('/local/news', 'FrontendController@localNews')->name('local.news');

Route::get('/local/reservations', 'FrontendController@localReservations')->name('local.reservations');

Route::get('/local/show/{id}', 'FrontendController@localShow')->name('local.show');