<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\BranchOffice\BranchOfficeRepository;

class BranchController extends Controller
{
    /**
     * @var BranchOfficeRepository
     */
    private $branchs;

    /**
     * BranchController constructor.
     * @param 
     */
    public function __construct(BranchOfficeRepository $branchs){
        $this->middleware('locale'); 
        $this->middleware('timezone'); 
        $this->middleware(['panel:admin']);
        $this->branchs = $branchs;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $locales = $this->branchs->paginate(10, $request->search);
        if ( $request->ajax() ) {

            if (count($locales)) {
                return response()->json([
                    'success' => true,
                    'view' => view('branchs.list', compact('locales'))->render(),
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => trans('app.no_records_found')
                ]);
            }
        }

        return view('branchs.index', compact('locales'));
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
