<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Banner\BannerRepository;

class BannerController extends Controller
{
    /**
     * @var BannerRepository
     */
    private $banners;

    /**
     * BannerController constructor.
     * @param 
     */
    public function __construct(BannerRepository $banners){
        $this->middleware('locale'); 
        $this->middleware('timezone'); 
        $this->middleware(['panel:admin']);
        $this->banners = $banners;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $banners = $this->banners->orderBy('priority', 'asc')->paginate(10);
        if ( $request->ajax() ) {

            if (count($banners)) {
                return response()->json([
                    'success' => true,
                    'view' => view('banners.list', compact('banners'))->render(),
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => trans('app.no_records_found')
                ]);
            }
        }

        return view('banners.index', compact('banners'));
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
