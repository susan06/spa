<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Repositories\BranchOffice\BranchOfficeRepository;
use App\Repositories\Reservation\ReservationRepository;

class ReservationController extends Controller
{
      /**
     * @var BranchOfficeRepository
     */
    private $branchs;

    /**
     * @var ReservationRepository
     */
    private $reservations;

    /**
     * BranchController constructor.
     * @param 
     */
    public function __construct(BranchOfficeRepository $branchs, ReservationRepository $reservations){
        $this->middleware('locale'); 
        $this->middleware('timezone'); 
        $this->branchs = $branchs;
        $this->reservations = $reservations;
        $this->middleware('permission:reservation.manage');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	$showLocal = true;
        $branch_list = null;
        if (Auth::user()->hasRole('admin')) {
            $reservations = $this->reservations->paginate(10, $request->search);
        }

        if (Auth::user()->hasRole('owner')) {
            $branch_list = $this->branchs->branchList(Auth::user()->id);
            $reservations = $this->reservations->search_paginate(10, Auth::user()->id, $request->branch,  $request->date, $request->search);
        }

        if ( $request->ajax() ) {

            if (count($reservations) > 0) {
                return response()->json([
                    'success' => true,
                    'view' => view('branchs.list_reservations', compact('reservations', 'showLocal'))->render(),
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => trans('app.no_records_found')
                ]);
            }
        }

        return view('reservations.index', compact('reservations', 'branch_list', 'showLocal'));
    }
}
