<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use Settings;
use Illuminate\Http\Request;
use App\Mailers\UserMailer;
use App\Support\User\UserStatus;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests\Auth\RegisterRequest;
use App\Repositories\User\UserRepository;
use App\Repositories\Role\RoleRepository;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * @var UserRepository
     */
    private $users;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $users)
    {
        $this->middleware('guest');
        $this->users = $users;
        $this->middleware('registration', ['only' => ['form_registration', 'registration']]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $rules = [
            'name' => 'required|max:30',
            'lastname' => 'required|max:30',
            'email' => 'required|email|max:255|unique:users',
            'phone' => 'required|numeric',
            'mobile' => 'required|numeric',
            'agent_external' => 'required',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
        ];
        if (Settings::get('terms_and_conditions_show')) {
            $rules['accept_terms'] = 'accepted';
        }
        return Validator::make($data, $rules);
    }

     /**
     * form registration.
     *
     */
    public function form_registration(Request $request)
    {
        if ( $request->ajax() ) {
            return response()->json([
                'success' => true,
                'view' => view('auth.register')->render()
            ]);
        }

        return view('auth.register');
    }

     /**
     * Handle a registration request for the application.
     *
     * @param RegisterRequest $request
     * @param UserMailer $mailer
     * @param RoleRepository $roles
     * @return \Illuminate\Http\Route
     */
    public function registration(Request $request, UserMailer $mailer, RoleRepository $roles)
    {
        $data = [
            'name' => $request->name,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'phone' => $request->phone,
            'mobile' => $request->mobile,
            'agent_external' => $request->agent_external,
            'password' => $request->password,
            'password_confirmation' => $request->password_confirmation
        ];
        if (Settings::get('terms_and_conditions_show')) {
            $data['accept_terms'] = $request->accept_terms;
        }
        $validator = $this->validator($data);
        if ( $validator->passes() ) {
            $user = $this->users->create(array_merge(
                $request->only('name', 'lastname', 'email', 'phone', 'mobile'),
                [
                    'status' => UserStatus::BANNED, 
                    'password' => $request->password, 
                    'lang' => Settings::get('language_default') 
                ]
            ));   

            $role = $roles->where('name', $request->agent_external)->first();
            $this->users->setRole($user->id, $role->id);
            $this->logAction('create', trans('log.created_account_agent_external'), 'user');

            $message = trans('app.account_created_login_agent_external');

            if ( $request->ajax() ) {

                return response()->json([
                    'success' => true,
                    'message' => $message
                ]);
            } 

            return redirect('login')->withSuccess($message);

        } else {

            $messages = $validator->errors()->getMessages();

            if ( $request->ajax() ) {

                return response()->json([
                    'success' => false,
                    'validator' => true,
                    'message' => $messages
                ]);
            } 

            return redirect('login')->withErrors($messages);
            
        }   
    }

    /**
     * Send email account confirmation
     * @param UserMailer $mailer
     * @param $user
     */
    private function sendConfirmationEmail(UserMailer $mailer, $user)
    {
        $token = str_random(60);
        $this->users->update($user->id, ['confirmation_token' => $token]);
        $mailer->sendConfirmationEmail($user, $token);
        $this->logAction('auth', trans('log.end_confirmation_email'), 'user', $user->id);
    }
}
