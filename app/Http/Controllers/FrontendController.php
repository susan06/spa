<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Repositories\Banner\BannerRepository;
use App\Repositories\BranchOffice\BranchOfficeRepository;
use App\Repositories\Faq\FaqRepository;
use App\Repositories\Comment\CommentRepository;

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
     * @var FaqRepository
     */
    private $faqs;

    /**
     * @var FaqRepository
     */
    private $comments;

    /**
     * FrontendController constructor.
     * @param 
     */
    public function __construct(
        BannerRepository $banners, 
        BranchOfficeRepository $branchs,
        FaqRepository $faqs,
        CommentRepository $comments
    ){
        $this->middleware('locale'); 
        $this->middleware('timezone'); 
        $this->banners = $banners;
        $this->branchs = $branchs;
        $this->faqs = $faqs;
        $this->comments = $comments;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $banners = $this->banners->where('status', true)->get();
        $score = isset($request->score) ? $request->score : 'service';
        $locales = $this->getlocalByScore(6, $score);

        if ( $request->ajax() ) {
            return response()->json([
                'success' => true,
                'view' => view('frontend.branchs.score', compact('locales', 'score'))->render(),
            ]);
        }

        return view('frontend.index', compact('banners', 'locales', 'score'));
    }

    /**
     * Display rhe local by id
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function localShow($id)
    {
        $local = $this->branchs->find($id);
        $comments = $this->comments->where('branch_office_id', $id)->paginate(10);

        return view('frontend.branchs.show', compact('local', 'comments'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function localSearch(Request $request)
    {
        $locales = $this->getlocalByScore(6, $request->score);
        $score = $request->score;

        if ( $request->ajax() ) {
            if (count($locales)) {
                return response()->json([
                    'success' => true,
                    'view' => view('frontend.branchs.score', compact('locales', 'score'))->render(),
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => trans('app.no_records_found')
                ]);
            }
        }

        return view('frontend.branchs.score', compact('locales', 'score'));
    }

    /**
     * get locales by score
     *
     */
    public function getlocalByScore($take, $score)
    {
        return $this->branchs->searchByScore($take, $score);
    }

    /**
     * Display local News
     *
     * @return \Illuminate\Http\Response
     */
    public function localNews(Request $request)
    {
        $locales = $this->branchs->orderBy('created_at', 'desc')->paginate(10);
        $paginate = false;

        if ( $request->ajax() ) {
            if (count($locales)) {
                return response()->json([
                    'success' => true,
                    'view' => view('frontend.branchs.list', compact('locales', 'paginate'))->render(),
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => trans('app.no_records_found')
                ]);
            }
        }

        return view('frontend.news', compact('locales', 'paginate'));
    }
  
    /**
     * Display local News
     *
     * @return \Illuminate\Http\Response
     */
    public function localReservations(Request $request)
    {
        $locales = $this->branchs->where('reservation_web', true)->paginate(10);
        $paginate = true;

        if ( $request->ajax() ) {
            if (count($locales)) {
                return response()->json([
                    'success' => true,
                    'view' => view('frontend.branchs.list', compact('locales', 'paginate'))->render(),
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => trans('app.no_records_found')
                ]);
            }
        }

        return view('frontend.reservation_web', compact('locales', 'paginate'));
    }

    /**
     * Display a listing by favorites
     *
     */
    public function localFavorites(Request $request)
    {
        $client = Auth::User()->id;
        $locales = $this->branchs->getLocalFavorites(10, $client);
        $paginate = true;

        if ( $request->ajax() ) {
            return response()->json([
                'success' => true,
                'view' => view('frontend.branchs.my_list', compact('locales', 'paginate'))->render(),
            ]);
        }

        return view('frontend.favorites', compact('locales', 'paginate'));
    }

    /**
     * save local in favorite
     *
     */
    public function localStoreFavorite($id, Request $request)
    {
        if(Auth::check()) {

            $client = Auth::User()->id;

            $favorite = $this->branchs->storeFavorite($id, $client);

            if($favorite) {
                $message = 'Se ha añadido el local a sus favoritos';

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

        if ( $request->ajax() ) {
            return response()->json([
                'success' => false,
                'login' => route('login')
            ]);
        }

        return redirect()->route('login');
    }

    /**
     * delete local in favorite
     *
     */
    public function localDeleteFavorite($id, Request $request)
    {
        if(Auth::check()) {

            $client = Auth::User()->id;

            $favorite = $this->branchs->deleteFavorite($id, $client);

            if($favorite) {
                $message = 'Se ha eliminado el local de sus favoritos';

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

        if ( $request->ajax() ) {
            return response()->json([
                'success' => false,
                'login' => route('login')
            ]);
        }

        return redirect()->route('login');
    }
     /**
     * Display a listing by visit
     *
     */
    public function localVisites(Request $request)
    {
        $client = Auth::User()->id;
        $locales = $this->branchs->getLocalVisites(10, $client);
        $paginate = true;

        if ( $request->ajax() ) {
            return response()->json([
                'success' => true,
                'view' => view('frontend.branchs.my_list', compact('locales', 'paginate'))->render(),
            ]);
        }

        return view('frontend.visites', compact('locales', 'paginate'));
    }

    /**
     * save local in visit
     *
     */
    public function localStoreVisit($id, Request $request)
    {
        if(Auth::check()) {

            $client = Auth::User()->id;

            $visit = $this->branchs->storeVisit($id, $client);

            if($visit) {
                $message = 'Se ha añadido el local a sus lugares visitados';

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

        if ( $request->ajax() ) {
            return response()->json([
                'success' => false,
                'login' => route('login')
            ]);
        }

        return redirect()->route('login');
    }

    /**
     * Display faqs
     *
     * @return \Illuminate\Http\Response
     */
    public function faqs(Request $request)
    {
        $faqs = $this->faqs->all();
        if ( $request->ajax() ) {
            if (count($faqs)) {
                return response()->json([
                    'success' => true,
                    'view' => view('frontend.faqs.list', compact('faqs'))->render(),
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => trans('app.no_records_found')
                ]);
            }
        }

        return view('frontend.faqs.index', compact('faqs'));
    }

    /**
     * Display conditions
     *
     * @return \Illuminate\Http\Response
     */
    public function conditions(Request $request)
    {

        return view('frontend.conditions');
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
