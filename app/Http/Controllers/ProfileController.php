<?php

namespace App\Http\Controllers;

use Auth;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Repositories\User\UserRepository;
use App\Repositories\Role\RoleRepository;
use App\Support\User\UserStatus;
use App\Http\Requests\User\UpdateProfile;
use App\Http\Requests\User\UpdateAvatar;

class ProfileController extends Controller
{
    /**
     * @var UserRepository
     */
    private $users;

    /**
     * UsersController constructor.
     * @param UserRepository $users
     */
    public function __construct(UserRepository $users)
    {
        $this->middleware('auth');
        $this->middleware('locale'); 
        $this->middleware('timezone'); 
        $this->users = $users;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        if ( $request->ajax() ) {

            return response()->json([
                'success' => true,
                'view' => view('users.profile', compact('user'))->render(),
            ]);
        }

        return view('users.profile', compact('user'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfile $request, $id)
    {
        $data = [
            'username' => $request->username,
            'name' => $request->name,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'phone' => $request->phone,
            'mobile' => $request->mobile,
            'birthday' => $request->birthday,
            'address' => $request->address
        ];

        $user = $this->users->update($id, $data);
        if ( $user ) {
            $this->logAction('update', trans('log.updated_profile'), 'user', $user->id);
            if ( $request->ajax() ) {

                return response()->json([
                    'success' => true,
                    'message' => trans('app.user_updated')
                ]);
            }

            return back()->withSuccess(trans('app.user_updated'));

        } else {
            
            if ( $request->ajax() ) {

                return response()->json([
                    'success' => false,
                    'message' => trans('app.error_again')
                ]);
            }

            return back()->withErrors(trans('app.error_again'));
            
        }
    }

    /**
     * show
     *
     */
    public function show()
    {
        //
    }

    /**
     * update img avatar
     *
     */
    public function updateAvatar(UpdateAvatar $request)
    {
        $file = $request->avatar;
        $date = new DateTime();
        if(Auth::user()->avatar){
            $file_name = Auth::user()->avatar;
        } else {
            $file_name = $date->getTimestamp().'.'.$file->extension();
        }
        if($file){
            if ($file->isValid()) {
                \File::delete(storage_path('app/users').'/'.$file_name);
                Storage::delete($file_name);
                $date = new DateTime();
                $file_name = $date->getTimestamp().'.'.$file->extension();
                $path = $file->storeAs('users', $file_name);
            }else{

                return back()->withError(trans('app.error_upload_file'));
            }
        }
        $data = [
            'avatar' => $file_name
        ];
        $user = $this->users->update(Auth::user()->id, $data);

        if ( $user ) {
            $this->logAction('update', trans('log.updated_avatar'), 'user', $user->id);
            return back()->withSuccess(trans('app.update_photo')); 
        } else {
            
            return back()->withError(trans('app.error_again'));
        }
    }

}
