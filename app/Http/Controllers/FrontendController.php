<?php

namespace App\Http\Controllers;

use Auth;
use Validator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Mailers\NotificationMailer;
use App\Repositories\Faq\FaqRepository;
use App\Repositories\User\UserRepository;
use App\Http\Requests\Message\CreateMessage;
use App\Repositories\Banner\BannerRepository;
use App\Repositories\Comment\CommentRepository;
use App\Repositories\Message\MessageRepository;
use App\Repositories\BranchOffice\BranchOfficeRepository;
use App\Repositories\Reservation\ReservationRepository;
use App\Http\Requests\Reservation\CreateReservation;

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
     * @var commentRepository
     */
    private $comments;

    /**
     * @var ReservationRepository
     */
    private $reservations;

    /**
     * @var MessageRepository
     */
    private $messages;

    /**
     * @var UserRepository
     */
    private $users;

    /**
     * FrontendController constructor.
     * @param 
     */
    public function __construct(
        BannerRepository $banners, 
        BranchOfficeRepository $branchs,
        FaqRepository $faqs,
        CommentRepository $comments,
        ReservationRepository $reservations,
        MessageRepository $messages,
        UserRepository $users
    ){
        $this->middleware('locale'); 
        $this->middleware('timezone'); 
        $this->middleware('auth.front', ['except' => [
            'index', 'localShow', 'localSearch', 'getlocalByScore', 'localNews', 'localReservations', 'conditions', 'faqs'
        ]]);
        $this->banners = $banners;
        $this->branchs = $branchs;
        $this->faqs = $faqs;
        $this->comments = $comments;
        $this->reservations = $reservations;
        $this->messages = $messages;
        $this->users = $users;
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function localSearch(Request $request)
    {
        $locales = $this->branchs->search(10, $request);
        $search = ($request->search) ?  true : false;
        $view = ($request->reservation_web) ? 'frontend.branchs.list_search' : 'frontend.branchs.list_search_score';
        $score = $request->score;
        $recommendation = $request->recommendation;

        if ( $request->ajax() ) {

            return response()->json([
                'success' => true,
                'view' => view($view, compact('locales', 'search', 'score', 'recommendation'))->render(),
            ]);
        }

        return view('frontend.branchs.search', compact('locales', 'search'));
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
    public function localScore(Request $request)
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

    /**
     * delete local in favorite
     *
     */
    public function localDeleteFavorite($id, Request $request)
    {
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

    /**
     * save vote of local
     *
     */
    public function localStoreVote($id, Request $request)
    {
        $rules = [
            'service' => 'required',
            'environment' => 'required',
            'attention' => 'required',
            'price' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ( $validator->passes() ) {

            $client = Auth::User()->id;

            $data = [
                'branch_office_id' => $id,
                'client_id' => $client,
                'service' => $request->service,
                'environment' => $request->environment,
                'attention' => $request->attention,
                'price' => $request->price,
            ];

            $vote = $this->branchs->storeVote($data);

            if($vote) {
                $message = 'Se ha registrado su calificación';

                if ( $request->ajax() ) {

                    $request->session()->flash('success', $message);

                    return response()->json([
                        'success' => true,
                        'url_return' => route('local.show', $id)
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

        } else {
            $messages = $validator->errors()->getMessages();

            if ( $request->ajax() ) {

                return response()->json([
                    'success' => false,
                    'validator' => true,
                    'message' => $messages
                ]);
            } 

            return back()->withErrors($messages); 
        }
    }

     /**
     * Display list of reservation of client
     *
     * @return \Illuminate\Http\Response
     */
    public function myReservations(Request $request)
    {
        $client = Auth::User()->id;
        $reservations = $this->reservations->where('client_id', $client)->orderBy('created_at', 'desc')->paginate(10);

        if ( $request->ajax() ) {
            if (count($reservations)) {
                return response()->json([
                    'success' => true,
                    'view' => view('frontend.reservations.list', compact('reservations'))->render(),
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => trans('app.no_records_found')
                ]);
            }
        }

        return view('frontend.reservations.myList', compact('reservations'));
    }

    /**
     * save local in favorite
     *
     */
    public function localStoreReservation($id, CreateReservation $request, NotificationMailer $mailer)
    {
        $client = Auth::User()->id;

        $data = [
            'branch_office_id' => $id,
            'client_id' => $client,
            'date' => $request->date,
            'hour' => $request->hour,
        ];

        $reservation = $this->reservations->create($data);

        if($reservation) {
            $mailer->sendReservationOwner($reservation);

            $message = 'Se ha guardado su reservación, puede encontrarla en la sección de MIS RESERVAS';

            if ( $request->ajax() ) {

                return response()->json([
                    'success' => true,
                    'message' => $message,
                    'reservation' => true
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

    /**
     * change status of reservation
     *
     */
    public function reservationCancel($id, Request $request, NotificationMailer $mailer)
    {
        $reservation = $this->reservations->update($id, ['status' => 'rejected']);

        if($reservation) {
            $mailer->sendReservationStatusOwner($reservation);

            $message = 'Se ha cambiado el estatus de su reserva';

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

    /**
     * save recommendation od local
     *
     */
    public function reservationStoreRecommend($id, Request $request, NotificationMailer $mailer)
    {
        $client = Auth::User()->id;
        $friends = $request->friends;
        $friends = explode(',',$friends);

        foreach ($friends as $key => $value) {

            $data = [
                'branch_office_id' => $id,
                'client_id' => $client,
                'friend' => $value
            ];

            if(filter_var($value, FILTER_VALIDATE_EMAIL)) {

                $friend = $this->branchs->storeRecommend($data);

                $mailer->sendRecommendation($id, $value, Auth::user()->full_name());
            }
            
            if ( $request->ajax() ) {

                $request->session()->flash('success', trans('app.invitations_sended'));

                return response()->json([
                    'success' => true,
                    'message' => trans('app.invitations_sended'),
                    'url_return' => route('local.show', $id)
                ]);
            } 

            return back()->withSuccess(trans('app.invitations_sended'));
        }
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
     * Display a messages
     *
     * @return \Illuminate\Http\Response
     */
    public function messages(Request $request)
    {
        $client = Auth::User()->id;

        $messages = $this->messages->where('user_from', $client)->paginate(10);

        if ( $request->ajax() ) {
            return response()->json([
                'success' => true,
                'view' => view('frontend.messages.list', compact('messages'))->render(),
            ]);
        }

        return view('frontend.messages.index', compact('messages'));
    }

    /**
     * create message, queja o sugerencia
     *
     */
    public function messageCreate(Request $request)
    {
        if ( $request->ajax() ) {
            return response()->json([
                'success' => true,
                'view' => view('frontend.messages.fields')->render(),
            ]);
        }

        return view('frontend.messages.create');
    }

    /**
     * message show
     *
     */
    public function messageShow($id, Request $request)
    {
        $message = $this->messages->find($id);

        if ( $request->ajax() ) {
            return response()->json([
                'success' => true,
                'view' => view('frontend.messages.show_modal', compact('message'))->render(),
            ]);
        }

        return view('frontend.messages.show_modal', compact('message'));
    }

     /**
     * save message
     *
     */
    public function messageCreateStore(CreateMessage $request)
    {
        $client = Auth::User()->id;

        $data = [
            'user_to' => $this->users->getAdmin()->id,
            'user_from' => $client,
            'description' => $request->description,
            'send_from' => $request->send_from,
        ];

        $message = $this->messages->create($data);

        if($message) {

            $message = 'Se ha enviado su mensaje al supervisor del sistema';

            $request->session()->flash('success', $message);

            if ( $request->ajax() ) {

                return response()->json([
                    'success' => true,
                    'message' => $message,
                    'url_return' => $request->send_from
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
