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

Route::get('/faqs', 'FrontendController@faqs')->name('faqs');

Route::get('/conditions', 'FrontendController@conditions')->name('conditions');

Route::get('/local/search', 'FrontendController@localSearch')->name('local.search');
Route::get('/local/score', 'FrontendController@localScore')->name('local.score');
Route::get('/local/news', 'FrontendController@localNews')->name('local.news');
Route::get('/local/reservations', 'FrontendController@localReservations')->name('local.reservations');
Route::get('/local/show/{id}', 'FrontendController@localShow')->name('local.show');
Route::get('/local/favorite', 'FrontendController@localFavorites')->name('local.favorites')->middleware('auth');
Route::get('/local/store/favorite/{id}', 'FrontendController@localStoreFavorite')->name('local.favorite.store');
Route::get('/local/delete/favorite/{id}', 'FrontendController@localDeleteFavorite')->name('local.favorite.delete');
Route::get('/local/by/location', 'FrontendController@localByLocation')->name('local.location');

Route::get('/local/visit', 'FrontendController@localVisites')->name('local.visites');
Route::get('/local/store/visit/{id}', 'FrontendController@localStoreVisit')->name('local.visit.store');
Route::post('/local/store/vote/{id}', 'FrontendController@localStoreVote')->name('local.vote.store');
Route::post('/local/store/reservation/{id}', 'FrontendController@localStoreReservation')->name('local.reservation.store');
Route::get('/my/reservations', 'FrontendController@myReservations')->name('local.my.reservations');
Route::get('/reservation/cancel/{id}', 'FrontendController@reservationCancel')->name('reservation.cancel');
Route::get('/reservation/recommend/{id}', 'FrontendController@reservationStoreRecommend')->name('local.recommend.store');
Route::post('/reservation/recommend/{id}', 'FrontendController@reservationStoreRecommend')->name('local.recommend.store');

Route::get('/message/show/{id}', 'FrontendController@messageShow')->name('message.show');
Route::get('/message/create', 'FrontendController@messageCreate')->name('message.create');
Route::post('/message/store', 'FrontendController@messageCreateStore')->name('message.store');
Route::get('/messages', 'FrontendController@messages')->name('messages');
Route::get('/messages/count', 'FrontendController@countMessages')->name('message.count');

Route::get('/my/tours', 'FrontendController@myTours')->name('local.my.tours');
Route::get('/tour/reservation/cancel/{id}', 'FrontendController@reservationTourCancel')->name('reservation.tour.cancel');
Route::post('/tour/store/reservation/{id}', 'FrontendController@tourStoreReservation')->name('tour.reservation.store');
/**
 * Social Facebook Login
 */
Route::get('auth/{provider}/login', [
    'as' => 'social.login',
    'uses' => 'Auth\SocialAuthController@redirectToProvider',
    'middleware' => 'social.login'
]);

Route::get('auth/{provider}/callback', 'Auth\SocialAuthController@handleProviderCallback');