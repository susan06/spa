<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Session;
use Socialite;
use App\Http\Controllers\Controller;
use App\Support\User\UserStatus;
use App\Repositories\Role\RoleRepository;
use App\Repositories\User\UserRepository;
use Laravel\Socialite\Contracts\User as SocialUser;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SocialAuthController extends Controller
{
    /**
     * @var UserRepository
     */
    private $users;

    /**
     * @var RoleRepository
     */
    private $roles;

    public function __construct(UserRepository $users, RoleRepository $roles)
    {
        $this->middleware('guest');

        $this->users = $users;
        $this->roles = $roles;
    }

    /**
     * Redirect user to specified provider in order to complete the authentication process.
     *
     * @param $provider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectToProvider($provider)
    {
        if (strtolower($provider) == 'facebook') {
            return Socialite::driver('facebook')->with(['auth_type' => 'rerequest'])->redirect();
        }
        
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Handle response authentication provider.
     *
     * @param $provider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleProviderCallback($provider)
    {
        $socialUser = $this->getUserFromProvider($provider);

        $user = $this->users->findBySocialId($provider, $socialUser->getId());

        if (! $user) {
            $user = $this->createOrAssociateAccountForUser($socialUser, $provider);
        }

        return $this->loginAndRedirect($user);
    }

    /**
     * Get user from authentication provider.
     *
     * @param $provider
     * @return SocialUser
     */
    private function getUserFromProvider($provider)
    {
        try {
            $providerUser = Socialite::driver($provider)->user();
            
            return $providerUser;

          } catch (RequestException $e) {

          dd($e->getResponse()->json());
        }
    }

    /**
     * Create account for user authenticated via social network.
     * If user with the same email address retrieved from social network
     * exists in our database, just associate it with provided social account.
     *
     * @param SocialUser $socialUser
     * @param $provider
     * @return \App\User
     */
    private function createOrAssociateAccountForUser(SocialUser $socialUser, $provider)
    {
        $user = $this->users->findByEmail($socialUser->getEmail());

        if (! $user) {

            // User with email retrieved from social auth provider does not
            // exist in our database. That means that we have to create new user here
            list($firstName, $lastName) = $this->parseUserFullName($socialUser);

            $user = $this->users->create([
                'email' => $socialUser->getEmail(),
                'password' => str_random(10),
                'name' => $firstName,
                'lastname' => $lastName,
                'phone' => null,
                'status' => UserStatus::ACTIVE,
                'avatar' => $socialUser->getAvatar(),
                'facebook' => 'https://www.facebook.com/'.$socialUser->getId()
            ]);

            $role = $this->roles->where('name', 'client')->first();
            $user->attachRole($role);

        } else {
            $this->users->update($user->id, [
                'email' => $socialUser->getEmail(),
                'first_name' => isset($firstName) ? $firstName : null,
                'last_name' => isset($lastName) ? $lastName : null,
                'phone' => null,
                'avatar' => $socialUser->getAvatar()
            ]);
        }

        // Associate social account with user account inside our application
        $this->users->associateSocialAccountForUser($user->id, $provider, $socialUser);

        return $user;
    }

    /**
     * Parse User's name from his social network account.
     *
     * @param SocialUser $user
     * @return array
     */
    private function parseUserFullName(SocialUser $user)
    {
        $name = $user->getName();

        if (strpos($name, " ") !== FALSE) {
            return explode(" ", $name, 2);
        }

        return [$name, ''];
    }

    /**
     * Log provided user in and redirect him to intended page.
     *
     * @param $user
     * @return \Illuminate\Http\RedirectResponse
     */
    private function loginAndRedirect($user)
    {
        Auth::login($user);

        if(! $user->email) {
            return redirect()->route('profile.index')->withProfile(true);
        }

        return redirect()->route('index');
    }

    /**
     * Get social account from session or display 404
     * page if someone is trying to access this page directly.
     *
     * @return mixed
     */
    private function getSocialAccountFromSession()
    {
        $account = Session::get('social.user');

        if (! $account) {
            throw new NotFoundHttpException;
        }

        return $account;
    }

}