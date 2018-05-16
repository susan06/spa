<?php

namespace App\Http\Controllers;

use Auth;
use Validator;
use Settings;
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
use App\Repositories\Province\ProvinceRepository;
use App\Repositories\Tour\TourRepository;
use App\Repositories\Tour\TourReservationRepository;

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
     * @var ProvinceRepository
     */
    private $provinces;

    /**
     * @var TourRepository
     */
    private $tours;

    /**
     * @var TourReservationRepository
     */
    private $tour_reservations;

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
        UserRepository $users,
        ProvinceRepository $provinces,
        TourRepository $tours,
        TourReservationRepository $tour_reservations

    ){
        $this->middleware('locale'); 
        $this->middleware('timezone'); 
        $this->middleware('auth.front', ['except' => [
            'index', 'localShow', 'localScore', 'localSearch', 'getlocalByScore', 'localNews', 'localReservations', 'conditions', 'faqs', 'localByLocation'
        ]]);
        $this->banners = $banners;
        $this->branchs = $branchs;
        $this->faqs = $faqs;
        $this->comments = $comments;
        $this->reservations = $reservations;
        $this->messages = $messages;
        $this->users = $users;
        $this->provinces = $provinces;
        $this->tour_reservations = $tour_reservations;
        $this->tours = $tours;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $banners = $this->banners->where('status', true)->orderBy('priority', 'asc')->get();
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
        $view = ($request->reservation_web || $request->province_id) ? 'frontend.branchs.list_search' : 'frontend.branchs.list_search_score';
        $score = $request->score;
        $recommendation = $request->recommendation;
        $province = $request->province_id;
        $provinces = ['' => 'seleccionar provincia'] + $this->provinces->lists('name', 'id');

        if ( $request->ajax() ) {

            return response()->json([
                'success' => true,
                'view' => view($view, compact('locales', 'search'))->render(),
            ]);
        }

        return view('frontend.branchs.search', compact('locales', 'provinces', 'search'));
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
        $locales = $this->branchs->where('status', true)->where('reservation_web', true)->paginate(10);
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
     * save local reservation
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
            $message = 'Se ha guardado su reservación, puede encontrarla en la sección de MIS RESERVAS';
            try {
                $mailer->sendReservationOwner($reservation);
            } 
              catch(\Swift_TransportException $e){
              $message = 'Se ha guardado su reservación, pero falló la conexión para el envio de la notificación a la administración.';
            }
              catch (\Exception $e) {
                $message = 'Se ha guardado su reservación, pero falló el envio de la notificación a la administración.';
            }

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
        $reservation = $this->reservations->update($id, ['rejected_by' => $request->rejected_by, 'status' => 'rejected']);

        if($reservation) {
            $message = 'Se ha cambiado el estatus de su reserva';
            try {
                $mailer->sendReservationStatusOwner($reservation);
            } 
              catch(\Swift_TransportException $e){
              $message = 'Se ha guardado el estatus de la reserva, pero falló la conexión para el envio de la notificación a la administración.';
            }
              catch (\Exception $e) {
                $message = 'Se ha guardado el estatus de la reserva, pero falló el envio de la notificación a la administración.';
            }

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
                $message = trans('app.invitations_sended');
                try {
                    $mailer->sendRecommendation($id, $value, Auth::user()->full_name());
                } 
                  catch(\Swift_TransportException $e){
                  $message = $message.'. Pero falló la conexión para el envio de la notificación por email.';
                }
                  catch (\Exception $e) {
                    $message = $message.'. Pero falló la conexión para el envio de la notificación por email.';
                }
            }
            
            if ( $request->ajax() ) {

                $request->session()->flash('success', trans('app.invitations_sended'));

                return response()->json([
                    'success' => true,
                    'message' => $message,
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
        $faqs = $this->faqs->where('status', 'Published')->get();
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

        $messages = $this->messages->where('user_from', $client)->orWhere('user_to', $client)->paginate(10);

        if ( $request->ajax() ) {
            return response()->json([
                'success' => true,
                'view' => view('messages.list', compact('messages'))->render(),
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
        $this->messages->update($id, ['read_on' => true]); 

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
            'subject' => $request->subject,
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

    /**
     * Get count message read off
     *
     * @return \Illuminate\Http\Response::JSON     
     */
    public function countMessages(Request $request)
    {
        return response()->json( 
            $this->messages->countMessages() 
        );
    }

    public function localByLocation(Request $request)
    {
        $distance = Settings::get('distance');
        $lat = $request->lat;
        $lng = $request->lng;
        $locales = $this->branchs->searchLocalByGps($lat, $lng, $distance);
        
        if ( $request->ajax() ) {
            return response()->json([
                'success' => true,
                'view' => view('frontend.branchs.locations', compact('lat', 'lng', 'locales'))->render(),
            ]);
        }

        return view('frontend.branchs.locations', compact('lat', 'lng', 'locales'));
    }

    /**
     * change status of reservation tour
     *
     */
    public function reservationTourCancel($id, Request $request, NotificationMailer $mailer)
    {
        $tour_reservation = $this->tour_reservations->update($id, ['rejected_by' => $request->rejected_by, 'status' => 'rejected']);

        if($tour_reservation) {
            $message = 'Se ha cambiado el estatus de su reservación del tour';
            try {
                $mailer->sendReservationTourStatusOwner($tour_reservation);
            } 
              catch(\Swift_TransportException $e){
              $message = 'Se ha cambiado el estado de su reservación del tour, pero falló la conexión para el envio de la notificación a la administración.';
            }
              catch (\Exception $e) {
                $message = 'Se ha cambiado el estado de su reservación del tour, pero falló el envio de la notificación a la administración.';
            }

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
     * save tour reservation
     *
     */
    public function tourStoreReservation($id, Request $request, NotificationMailer $mailer)
    {
        $client = Auth::User()->id;

        $data = [
            'tour_id' => $id,
            'client_id' => $client
        ];

        $exist_tour = $this->tour_reservations
            ->where('tour_id', $id)
            ->where('client_id', $client)
            ->whereIn('status', ['pendient', 'approved'])
            ->first();

        if(!$exist_tour) {
            $tour_reservation = $this->tour_reservations->create($data);

            if($tour_reservation) {
                $message = 'Se ha guardado su reservación del tour, puede encontrarla en la sección de MIS TOURS';

                try {
                    $mailer->sendTourReservationOwner($tour_reservation);
                } 
                  catch(\Swift_TransportException $e){
                  $message = 'Se ha guardado su reservación del tour, pero falló la conexión para el envio de la notificación a la administración.';
                }
                  catch (\Exception $e) {
                    $message = 'Se ha guardado su reservación del tour, pero falló el envio de la notificación a la administración.';
                }

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

        $message = 'Ya ha reservado el tour seleccionado';

            if ( $request->ajax() ) {

                return response()->json([
                    'success' => false,
                    'message' => $message
                ]);
            }

        return back()->withErrors($message);
    }

    /**
     * Display list of tours of client
     *
     * @return \Illuminate\Http\Response
     */
    public function myTours(Request $request)
    {
        $client = Auth::User()->id;
        $reservations = $this->tour_reservations->where('client_id', $client)->orderBy('created_at', 'desc')->paginate(10);

        if ( $request->ajax() ) {
            if (count($reservations)) {
                return response()->json([
                    'success' => true,
                    'view' => view('frontend.tours.list', compact('reservations'))->render(),
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => trans('app.no_records_found')
                ]);
            }
        }

        return view('frontend.tours.myList', compact('reservations'));
    }

}
