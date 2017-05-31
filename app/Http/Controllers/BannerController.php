<?php

namespace App\Http\Controllers;

use DateTime;
use Storage;
use Illuminate\Http\Request;
use App\Repositories\Banner\BannerRepository;
use App\Http\Requests\Banner\CreateBanner;
use App\Http\Requests\Banner\UpdateBanner;

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
        $this->middleware('permission:banner.manage');

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
    public function create(Request $request)
    {
        $edit = false;
        $status = [
            true => trans("app.Published"),
            false => trans("app.No Published")
        ];
        $order = [
            1  => '1',
            2  => '2',
            3  => '3',
            4  => '4',
            5  => '5',
            6  => '6',
            7  => '7',
            8  => '8',
            9  => '9',
            10  => '10'
        ];

        if ( $request->ajax() ) {
            return response()->json([
                'success' => true,
                'view' => view('banners.create-edit', compact('edit', 'status', 'order'))->render()
            ]);
        } 

        return view('banners.create-edit', compact('edit', 'status', 'order'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBanner $request)
    {
        $file = $request->image;
        $date = new DateTime();
        $file_name = $date->getTimestamp().'.'.$file->extension();
        
        if($file){
            if ($file->isValid()) {
                \File::delete(public_path('uploads/banners').'/'.$file_name);
                $path = $file->storeAs('uploads/banners', $file_name, 'banner');
            }else{

                return response()->json([
                    'success' => false,
                    'message' => trans('app.error_upload_file')
                ]);
   
            }
        }
        $data = [
            'name' => $file_name,
            'priority' => (int)$request->priority,
            'status' => ($request->status == '1') ? true : false
        ];

        $banner = $this->banners->create($data);
        if ( $banner ) {
            
            return response()->json([
                'success' => true,
                'message' => trans('app.banner_created')
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
    public function edit($id, Request $request)
    {
        $edit = true;
        $status = [
            '' => trans('app.selected_item'),
            true => trans("app.Published"),
            false => trans("app.No Published")
        ];
        $order = [
            1  => '1',
            2  => '2',
            3  => '3',
            4  => '4',
            5  => '5',
            6  => '6',
            7  => '7',
            8  => '8',
            9  => '9',
            10  => '10'
        ];
        if ( $banner = $this->banners->find($id) ) {
            return response()->json([
                'success' => true,
                'view' => view('banners.create-edit', compact('banner', 'edit', 'status', 'order'))->render()
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
    public function update($id, UpdateBanner $request)
    {
        $data = [
            'priority' => (int)$request->priority,
            'status' => ($request->status == '1') ? true : false
        ];
        $banner = $this->banners->update(
            $id, 
            $data
        );
        if ( $banner ) {
            
            return response()->json([
                'success' => true,
                'message' => trans('app.banner_updated')
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
    public function destroy($id, Request $request)
    {
        $banner = $this->banners->find($id);
        \File::delete(public_path('uploads/banners').'/'.$banner->name);
        if ( $this->banners->delete($id) ) {
            
            return response()->json([
                'success' => true,
                'message' => trans('app.banner_deleted')
            ]);
        } else {
            return response()->json([
                'success'=> false,
                'message' => trans('app.error_again')
            ]);
        }
        
    }
}
