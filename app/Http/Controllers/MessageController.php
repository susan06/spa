<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Repositories\Message\MessageRepository;
use App\Http\Requests\Message\CreateMessage;
use App\Repositories\User\UserRepository;

class MessageController extends Controller
{
    /**
     * @var MessageRepository
     */
    private $messages;

    /**
     * @var UserRepository
     */
    private $users;

    /**
     * MessageController constructor.
     * @param 
     */
    public function __construct(
        MessageRepository $messages,
        UserRepository $users
    ){
        $this->middleware('locale'); 
        $this->middleware('timezone'); 
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
        $user = Auth::User()->id;

        $messages = $this->messages->where('user_from', $user)->orWhere('user_to', $user)->paginate(10);

        if ( $request->ajax() ) {
            return response()->json([
                'success' => true,
                'view' => view('messages.list', compact('messages'))->render(),
            ]);
        }

        return view('messages.index', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ( $request->ajax() ) {
            return response()->json([
                'success' => true,
                'view' => view('messages.fields')->render(),
            ]);
        }

        return view('messages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMessage $request)
    {
        $user = Auth::User()->id;

        if (Auth::user()->hasRole('owner')) {
            $to = $this->users->getAdmin()->id;
        } else {
            $to = $request->user_to;
        }

        $data = [
            'user_to' => $to,
            'user_from' => $user,
            'subject' => $request->subject,
            'description' => $request->description
        ];

        $message = $this->messages->create($data);

        if($message) {

            if (Auth::user()->hasRole('owner')) {
                $message = 'Se ha enviado su mensaje al supervisor del sistema';
            } else {
                $message = 'Se ha enviado su mensaje al destinatario';
            }

            $request->session()->flash('success', $message);

            if ( $request->ajax() ) {

                return response()->json([
                    'success' => true,
                    'message' => $message,
                    'url_return' => route('messages-panel.index')
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
