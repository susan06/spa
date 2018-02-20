<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Mailers\NotificationMailer;
use App\Repositories\BranchOffice\BranchOfficeRepository;
use App\Repositories\Tour\TourRepository;
use App\Repositories\Tour\TourReservationRepository;
use App\Http\Requests\Tour\CreateTour;
use App\Http\Requests\Tour\CreateTourReservation;
use App\Http\Requests\Tour\UpdateTourReservation;

class TourController extends Controller
{
    /**
     * @var BranchOfficeRepository
     */
    private $branchs;

    /**
     * @var TourRepository
     */
    private $tours;

    /**
     * @var ReservationRepository
     */
    private $tour_reservations;

    /**
     * BranchController constructor.
     * @param 
     */
    public function __construct(BranchOfficeRepository $branchs, TourRepository $tours, TourReservationRepository $tour_reservations){
        $this->middleware('locale'); 
        $this->middleware('timezone'); 
        $this->middleware(['panel:owner']);
        $this->branchs = $branchs;
        $this->tours = $tours;
        $this->tour_reservations = $tour_reservations;
        $this->middleware('permission:tour.manage');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $branch_list = null;

        if (Auth::user()->hasRole('owner')) {
            $branch_list = $this->branchs->branchList(Auth::user()->id);
            $tours = $this->tours->search_paginate(10, Auth::user()->id, $request->branch, $request->search);
        }

        if ( $request->ajax() ) {

            if (count($tours)) {
                return response()->json([
                    'success' => true,
                    'view' => view('tours.list', compact('tours'))->render(),
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => trans('app.no_records_found')
                ]);
            }
        }

        return view('tours.index', compact('tours', 'branch_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $edit = false;
        $branch_list = $this->branchs->branchList(Auth::user()->id);
        $status = [
            true => trans("app.Published"),
            false => trans("app.No Published")
        ];

        if ( $request->ajax() ) {
            return response()->json([
                'success' => true,
                'view' => view('tours.create-edit', compact('edit', 'branch_list', 'status'))->render()
            ]);
        } 

        return view('tours.create-edit', compact('edit', 'branch_list', 'status'));
    }

   /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTour $request)
    {
        $tour = $this->tours->create($request->all());
        if ( $tour ) {
            
            return response()->json([
                'success' => true,
                'message' => trans('app.tour_created')
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
        $edit = true;
        $branch_list = $this->branchs->branchList(Auth::user()->id);
        $status = [
            true => trans("app.Published"),
            false => trans("app.No Published")
        ];

        if ( $tour = $this->tours->find($id) ) {
            return response()->json([
                'success' => true,
                'view' => view('tours.create-edit', compact('tour', 'edit', 'branch_list', 'status'))->render()
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateTour $request, $id)
    {
        $tour = $this->tours->update(
            $id, 
            $request->all()
        );
        if ( $tour ) {
            
            return response()->json([
                'success' => true,
                'message' => trans('app.tour_updated')
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
        $tour = $this->tours->find($id);
        if ( $this->tours->delete($id) ) {
            
            return response()->json([
                'success' => true,
                'message' => trans('app.tour_deleted')
            ]);
        } else {
            return response()->json([
                'success'=> false,
                'message' => trans('app.error_again')
            ]);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function reservations($id, Request $request)
    {
        $tour = $this->tours->find($id);
        $reservations = $this->tour_reservations->where('tour_id', $id)->orderBy('created_at')->paginate(10);

        if ( $request->ajax() ) {

            if (count($reservations) > 0) {
                return response()->json([
                    'success' => true,
                    'view' => view('tours.list_reservations', compact('reservations'))->render(),
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => trans('app.no_records_found')
                ]);
            }
        }

        return view('tours.reservations', compact('reservations', 'tour'));
    }

    /**
     * change status of reservation tour
     *
     */
    public function reservationTourApproved($id, Request $request, NotificationMailer $mailer)
    {
        $tour_reservation = $this->tour_reservations->update($id, ['status' => 'approved']);

        if($tour_reservation) {
            $mailer->sendReservationTourStatusOwner($tour_reservation, 'approved');

            $message = 'Se ha cambiado el estatus de su reservación del tour';

            if ( $request->ajax() ) {

                return response()->json([
                    'success' => true,
                    'message' => $message
                ]);
            }

            return back()->withSuccess($message);
        }

        $message = trans('app.error_again');

        if ( $request->ajax() ) {

            return response()->json([
                'success' => false,
                'message' => $message
            ]);
        }

        return back()->withErrors($message);
    }
}
