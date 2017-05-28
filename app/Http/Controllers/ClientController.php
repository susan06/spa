<?php

namespace App\Http\Controllers;

use DateTime;
use App\User;
use Illuminate\Http\Request;
use App\Repositories\User\UserRepository;
use App\Repositories\BranchOffice\BranchOfficeRepository;

class ClientController extends Controller
{
    /**
     * @var UserRepository
     */
    private $users;

    /**
     * @var BranchOfficeRepository
     */
    private $branchs;

    /**
     * UserController constructor.
     * @param UserRepository $roles
     */
    public function __construct(UserRepository $users, BranchOfficeRepository $branchs)
    {
        $this->middleware('auth');
        $this->middleware('locale'); 
        $this->middleware('timezone'); 
        $this->middleware('permission:users.manage');
        $this->users = $users;
        $this->branchs = $branchs;
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
        $users = $this->users->paginate_search_client(10, $request->search);
        $total = $this->users->totalClients();

        if ( $request->ajax() ) {
            if (count($users)) {
                return response()->json([
                    'success' => true,
                    'view' => view('clients.list', compact('users'))->render(),
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => trans('app.no_records_found')
                ]);
            }
        }

        return view('clients.index', compact('users', 'total'));
    }

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function localVisit(User $user, Request $request)
    {
        $locales = $this->branchs->searchLocalVisitByCLient(10, $user->id);

        if ( $request->ajax() ) {

            return response()->json([
                'success' => true,
                'view' => view('frontend.branchs.score', compact('locales'))->render(),
            ]);
        }

        return view('clients.local_visit', compact('locales', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
