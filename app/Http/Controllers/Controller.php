<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Support\Logger\LoggerTrait;
use Illuminate\Support\Facades\Request as RequestView;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, LoggerTrait;

    protected $noRecord; 

    /**
     * Controller constructor.
     */
    public function __construct()
    {
    	if(Auth::check()){
		    $user = User::find(Auth::user()->id);
		    Session::put('locale',$user->lang);
		}
		$this->noRecord = trans('app.no_records_found');
    }

    /*
     * return view if ajax json or reponse
     *
     */
    protected function makeResponse(
    	$view = null, 
    	$view_ajax = null, 
    	$objects = [],
    	$status = true, 
    	$message = ''
    ){
        if (RequestView::ajax()) {

            return response()->json([
                'success' => $status,
                'view' => view($view_ajax, $objects)->render(),
                'message' => $message
            ]);
        }

        return response()->view($view, $objects);
    }
}
