<?php

/*
|--------------------------------------------------------------------------
| Auth Routes backend or panel
|--------------------------------------------------------------------------
|
|
*/

 /**
  * Setting of system
  */
  Route::group([
       'prefix' => 'setting'
   ], function () {

      Route::get('/administration',
          'SettingController@administration')
          ->name('setting.administration');

      Route::post('/update',
          'SettingController@update')
          ->name('setting.update');

      Route::get('/conditions_and_privacy',
        'SettingController@conditions_and_privacy')
        ->name('setting.conditions_and_privacy');
   });

  Route::get('/parameter-search',
        'SettingController@parameterSearch')
        ->name('settings.search');

  /**
   * Adminitrations of Users
  */

  Route::group([
       'prefix' => 'user'
   ], function () {
      Route::get('/password', 
          'UserController@password')->name('user.password');
      Route::put('/password', 
          'UserController@change_password')->name('user.password.update');
      Route::get('/setting', 
          'UserController@setting')->name('user.setting');
      Route::put('/setting', 
          'UserController@update_setting')->name('user.setting.update');
      Route::get('/{id}/sessions', 
          'UserController@sessions')->name('user.sessions');
      Route::delete('/{id}/sessions', 
          'UserController@invalidateSession')->name('user.sessions.invalidate');
  });   

  Route::resource('user', 'UserController');

  /**
   *  Adminitrations of Roles
  */
  Route::resource('role', 'RoleController');

  /**
   *  Adminitrations of Permissions
  */
  Route::post('permission/save', [
      'as' => 'permission.save',
      'uses' => 'PermissionController@saveRolePermissions'
  ]);
  Route::resource('permission', 'PermissionController');


  /**
   *  Activitys
   */
  Route::get('activity/user/{id}', 'ActivityController@log_user')->name('activity.user');
  Route::resource('activity', 'ActivityController');


  Route::get('/home', 'HomeController@index')->name('home');

  Route::get('/img-file/{folder}/{image}', function($folder = null, $image = null)
  {
    $path = storage_path().'/app/'.$folder.'/'.$image;
    if (file_exists($path)) {
      return response()->file($path);
    }
  });

  Route::get('/public-img/{folder}/{image}', function($folder = null, $image = null)
  {
    $path = public_path().'/'.$folder.'/'.$image;
    if (file_exists($path)) {
      return response()->file($path);
    }
  });

  /**
  *  Profile
  */
  Route::put('profile/avatar', 'ProfileController@updateAvatar')->name('update.avatar');
  Route::resource('profile', 'ProfileController');

  /**
   * Exports
   */    
  Route::resource('export', 'ExportController');
  
  /*
   *
   * Notifications
   */
  Route::resource('notifications', 'NotificationController');

  /*
   *
   * clients
   */

  Route::group([
       'prefix' => 'client'
   ], function () {

    Route::get('/local/visit/{user}', [
        'as' => 'client.local.visit',
        'uses' => 'ClientController@localVisit'
    ]);

  });

  Route::resource('client', 'ClientController');

  /**
   * faqs
   */    
  Route::resource('faq', 'FaqController');
    