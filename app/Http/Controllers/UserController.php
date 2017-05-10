<?php

namespace App\Http\Controllers;

use Auth;
use Config;
use App;
use Session;
use App\User;
use DateTime;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Repositories\User\UserRepository;
use App\Repositories\Role\RoleRepository;
use App\Repositories\Activity\ActivityRepository;
use App\Repositories\Session\SessionRepository;
use App\Support\User\UserStatus;
use App\Notifications\StatusDoingChange;
use App\Http\Requests\User\CreateUser;
use App\Http\Requests\User\UpdateUser;
use App\Http\Requests\User\UpdatePassword;

class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    private $users;

    /**
     * UserController constructor.
     * @param UserRepository $roles
     */
    public function __construct(UserRepository $users)
    {
        $this->middleware('auth');
        $this->middleware('locale'); 
        $this->middleware('timezone'); 
        $this->middleware('session.database', ['only' => ['sessions', 'invalidateSession']]);
        $this->middleware('permission:users.manage', ['except' => ['changeStatusDoing']]);
        $this->users = $users;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $date = DateTime::createFromFormat('d-m-Y', $request->search);

        if($date && $date->format('d-m-Y')) {
            $search = date_format(date_create($request->search), 'Y-m-d');
        } else {
            $search = $request->search;
        }
        $users = $this->users->paginate_search(10, $request->search, $request->status);
        $status = ['' => trans('app.all_status')] + UserStatus::lists();
        if ( $request->ajax() ) {
            if (count($users)) {
                return response()->json([
                    'success' => true,
                    'view' => view('users.list', compact('users','status'))->render(),
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => trans('app.no_records_found')
                ]);
            }
        }

        return view('users.index', compact('users', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, RoleRepository $roleRepository)
    {
        $edit = false;
        $status = ['' => trans('app.selected_item')] + UserStatus::lists();
        $roles = $roleRepository->all();

        if ( $request->ajax() ) {
            return response()->json([
                'success' => true,
                'view' => view('users.create-edit', compact('edit','status','roles'))->render()
            ]);
        }

        return view('users.create-edit', compact('edit','status','roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\CreateUpdateUser  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUser $request)
    {
        $data = [
            'name' => $request->name,
            'lastname' => $request->lastname,
            'username' => $request->name,
            'email' => $request->email,
            'status' => $request->status,
            'phone' => $request->phone,
            'mobile' => $request->mobile,
            'birthday' => $request->birthday,
            'password' => 'secret',
            'status' => $request->status
        ];
       
        $user = $this->users->create($data);
        $this->users->setRole($user->id, $request->get('role'));
        if ( $user ) {

            $this->logAction('create', trans('log.created_account_for', ['name' => $user->full_name() ]), 'user', $user->id);

            return response()->json([
                'success' => true,
                'message' => trans('app.user_created_defaut_pass')
            ]);
        } else {
            
            return response()->json([
                'success' => false,
                'message' => trans('app.error_again')
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, ActivityRepository $activities_user)
    {
        $user = $this->users->find($id);

        $activities = $activities_user->getLatestActivitiesForUser($user->id, 10);

        return view('users.show', compact('user', 'activities'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request, RoleRepository $roleRepository)
    {
        $edit = true;
        $roles = $roleRepository->all();
        $status = UserStatus::lists();
        $user = $this->users->find($id);

        if ( $user ) {
            return response()->json([
                'success' => true,
                'view' => view('users.create-edit', compact('user', 'edit', 'roles', 'status' ))->render()
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => trans('app.no_record_found')
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\CreateUpdateUser  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response::JSON
     */
    public function update(UpdateUser $request, $id)
    {
        $data = [
            'name' => $request->name,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'status' => $request->status,
            'phone' => $request->phone,
            'mobile' => $request->mobile,
            'birthday' => $request->birthday
        ];

        $user = $this->users->update($id, $data);
        $this->users->updateRole($id,$request->get('role'));
        if ( $user ) {
            $this->logAction('update', trans('log.updated_profile_details_for', ['name' => $user->full_name() ]), 'user', $user->id);
            if($user->status == 'Banned') {
                $this->logAction('update',  trans('log.banned_user', ['name' => $user->full_name() ]), 'user', $user->id);
            }
            return response()->json([
                'success' => true,
                'message' => trans('app.user_updated')
            ]);
        } else {
            
            return response()->json([
                'success' => false,
                'message' => trans('app.error_again')
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {      
        if ( $id == Auth::id() ) {
            return response()->json([
                'success' => false,
                'message' => trans('app.you_cannot_delete_yourself')
            ]);
        }
        $user = $this->users->find($id);
        if ( !$this->users->delete($id) ) {
            $this->logAction('delete',  trans('log.deleted_user', ['name' => $user->full_name() ]), 'user', $user->id);
            return response()->json([
                'success' => true,
                'message' => trans('app.deleted_user')
            ]);
        } else {
            return response()->json([
                'success'=> false,
                'message' => trans('app.error_again')
            ]);
        }
    }

    /**
     * Change password
     *
     */
    public function password() {

        return view('users.change_password');
    }

    /**
     * change password.
     *
     */
    public function change_password(UpdatePassword $request) 
    {
        $this->updatePassword(Auth::user(), $request->get('password'));
        $this->logAction('update', trans('log.change_password'), 'user', Auth::user()->id);
        $message = trans('app.updated_password');

         if ( $request->ajax() ) {

            return response()->json([
                'success' => true,
                'message' => $message
            ]);
        } 

        return back()->withSuccess($message); 
    }

    /**
     * Change the given user's password.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword  $user
     * @param  string  $password
     * @return void
     */
    protected function updatePassword($user, $password)
    {
        $user->password = $password;
        $user->save();
    }

    /**
     * form setting of user
     *
     */
    public function setting() {

        $user = Auth::user();
        $languages = [
            'es' => trans('app.spanish'),
            'en' => trans('app.english')
        ]; 

        return view('users.setting', compact('user', 'languages'));
    }

    /**
     * Update setting of user
     *
     */
    protected function update_setting(Request $request)
    {
        $user = $this->users->update(Auth::user()->id, $request->all());

        if($user) {
            Config::set('app.locale', $request->get('lang'));
            App::setLocale($request->get('lang'));
            Session::put('locale', $request->get('lang'));
            $this->logAction('update', trans('log.updated_settings_user'), 'user', $user->id);

            if ( $request->ajax() ) {

                return response()->json([
                    'success' => true,
                    'message' => trans('app.settings_update')
                ]);
            }

            return back()->withSuccess(trans('app.settings_updated'));
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
     * Displays the list with all active sessions for selected user.
     *
     * @param User $user
     * @param SessionRepository $sessionRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sessions($id, SessionRepository $sessionRepository)
    {
        $sessions = $sessionRepository->where('user_id', $id)->get();
        $user = $this->users->find($id);

        return response()->json([
            'success' => true,
            'view' => view('users.sessions', compact('sessions', 'user'))->render(),
        ]);
    
    }

    /**
     * Invalidate specified session for selected user.
     *
     * @param User $user
     * @param $sessionId
     * @param SessionRepository $sessionRepository
     * @return mixed
     */
    public function invalidateSession($id, SessionRepository $sessionRepository)
    {
        $session = $sessionRepository->find($id);

        if ( !$sessionRepository->delete($id) ) {
            $this->users->update($session->user_id, ['remember_token' => null]);

            $this->logAction('update', trans('log.session_invalidate', ['name' => $session->users->first()->name, 'ip' => $session->ip_address]), 'session', $session->id);

            return response()->json([
                'success' => true,
                'message' => trans('app.session_invalidated')
            ]);
        } else {
            return response()->json([
                'success'=> false,
                'message' => trans('app.error_again')
            ]);
        }
    }

}
