<?php

namespace App\Http\Controllers;

use Settings;
use App;
use Config;
use Auth;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * SettingController constructor.
     * @param void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('locale'); 
        $this->middleware('timezone'); 
        $this->middleware('permission:settings.general');
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function administration(Request $request)
    {
        $languages = [
            'es' => trans('app.spanish'),
            'en' => trans('app.english')
        ]; 
        $timezones = config('timezone');
        if ( $request->ajax() ) {

            return response()->json([
                'success' => true,
                'view' => view('setting.administration_field', compact('languages', 'timezones'))->render(),
            ]);
        }

        return view('setting.administration', compact('languages', 'timezones'));
    }

    /**
     * Handle application settings update.
     *
     * @param Request $request
     * @return mixed
     */
    public function update(Request $request)
    {
        $this->updateSettings($request->except("_token"));

        return back()->withSuccess(trans('app.settings_updated'));
    }

    /**
     * Update settings and fire appropriate event.
     *
     * @param $input
     */
    private function updateSettings($input)
    {
        foreach($input as $key => $value) {
            Settings::set($key, $value);
            if ($key == 'language_default') {
                Config::set('app.locale', $value);
                App::setLocale($value);
            }
            if ($key == 'timezone') {
                Config::set('app.timezone', $value);
            }           
        }

        $this->logAction('update', trans('log.updated_settings'), 'setting');
    }
}
