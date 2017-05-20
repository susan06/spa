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

Route::get('/local/favorite', 'FrontendController@localFavorites')->name('local.favorites')->middleware('auth');

Route::get('/local/store/favorite/{id}', 'FrontendController@localStoreFavorite')->name('local.favorite.store')->middleware('auth');

Route::get('/local/delete/favorite/{id}', 'FrontendController@localDeleteFavorite')->name('local.favorite.delete')->middleware('auth');

Route::get('/local/visit', 'FrontendController@localVisites')->name('local.visites')->middleware('auth');

Route::get('/local/store/visit/{id}', 'FrontendController@localStoreVisit')->name('local.visit.store')->middleware('auth');

Route::post('/local/store/vote/{id}', 'FrontendController@localStoreVote')->name('local.vote.store')->middleware('auth');

Route::post('/local/store/reservation/{id}', 'FrontendController@localStoreReservation')->name('local.reservation.store')->middleware('auth');

