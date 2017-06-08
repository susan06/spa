<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use App\Repositories\Activity\ActivityRepository;
use App\Repositories\User\UserRepository;
use App\Support\User\UserStatus;
use App\Repositories\BranchOffice\BranchOfficeRepository; 

class HomeController extends Controller
{
    /**
     * @var UserRepository
     */
    private $users;

    /**
     * @var ActivityRepository
     */
    private $activities;

    /**
     * @var BranchOfficeRepository
     */
    private $branchs;

    /**
     * DashboardController constructor.
     * @param UserRepository $users
     * @param ActivityRepository $activities
     */
    public function __construct(UserRepository $users, ActivityRepository $activities, BranchOfficeRepository $branchs)
    {
        $this->middleware('auth');
        $this->middleware(['panel:admin|owner']);
        $this->middleware('locale'); 
        $this->middleware('timezone'); 
        $this->users = $users;
        $this->activities = $activities;
        $this->branchs = $branchs;
    }

    /**
     * Displays dashboard based on user's role.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        if (Auth::user()->hasRole('admin')) {
            return $this->adminDashboard();
        }

        return $this->ownerDashboard();
    }

    /**
     * Displays dashboard for admin users.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    private function adminDashboard()
    {
        $stats = [
            'total' => $this->users->count(),
            'new' => $this->users->newUsersCount(),
            'banned' => $this->users->countByStatus(UserStatus::BANNED),
            'unconfirmed' => $this->users->countByStatus(UserStatus::UNCONFIRMED),
            'company' => $this->branchs->countCompany(),
            'branchs' => $this->branchs->count(),
            'clients' => $this->users->countByRole('client'),
            'owners' => $this->users->countByRole('owner'),
        ];

        $latestRegistrations = $this->users->latest(7);

        return view('dashboard.admin', compact('stats', 'latestRegistrations'));
    }

    /**
     * Displays default dashboard for non-admin users.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    private function ownerDashboard()
    {
        $stats = [
            'company' => $this->branchs->countCompany(Auth::user()->id),
            'branchs' => $this->branchs->countByOwner(Auth::user()->id)
        ];

        return view('dashboard.owner', compact('stats'));
    }

    /**
     * clear page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function start()
    {
       return view('clear_page');
    }

}
