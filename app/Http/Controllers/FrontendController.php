<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Repositories\Banner\BannerRepository;
use App\Repositories\BranchOffice\BranchOfficeRepository;

class FrontendController extends Controller
{

    /**
     * @var BannerRepository
     */
    private $banners;

    /**
     * @var BranchOfficeRepository
     */
    private $branchs;

    /**
     * FrontendController constructor.
     * @param 
     */
    public function __construct(BannerRepository $banners, BranchOfficeRepository $branchs)
    {
        $this->middleware('locale'); 
        $this->middleware('timezone'); 
        $this->banners = $banners;
        $this->branchs = $branchs;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = $this->banners->where('status', true)->get();
        $locales = $this->getlocalByScore(10, 'service');
        $score = 'service';

        return view('frontend.index', compact('banners', 'locales', 'score'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function localSearch(Request $request)
    {
        $locales = $this->getlocalByScore(10, $request->score);
        $score = $request->score;

        if ( $request->ajax() ) {
            if (count($locales)) {
                return response()->json([
                    'success' => true,
                    'view' => view('frontend.branchs.list', compact('locales', 'score'))->render(),
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => trans('app.no_records_found')
                ]);
            }
        }

        return view('frontend.branchs.list', compact('locales', 'score'));
    }

    /**
     * get locales by score
     *
     */
    public function getlocalByScore($take, $score)
    {
        return $this->branchs->search($take, $score);
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
