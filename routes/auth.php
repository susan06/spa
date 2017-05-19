<?php

/*
|--------------------------------------------------------------------------
| Auth Routes backend or panel
|--------------------------------------------------------------------------
|
|
*/

    Route::get('login', 'Auth\LoginController@getLogin')->name('login');
    Route::get('logout', 'Auth\LoginController@getLogout')->name('auth.logout');
    Route::post('authenticate', 'Auth\LoginController@authenticate');
    Route::get('registration', 'Auth\RegisterController@form_registration');
    Route::post('register', 'Auth\RegisterController@registration');
    Route::get('register/confirmation/{token}', 'Auth\LoginController@confirmEmail')->name('confirm.email');
    Route::get('password/remind', 'Auth\ForgotPasswordController@forgotPassword');
    Route::post('password/remind', 'Auth\ForgotPasswordController@sendPasswordReminder');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@getReset');
    Route::post('password/reset', 'Auth\ResetPasswordController@postReset');
 
