<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use App\Repositories\BranchOffice\BranchOfficeRepository;
use App\Repositories\Company\CompanyRepository;
use App\Repositories\Province\ProvinceRepository;
use App\Repositories\MethodPayment\MethodPaymentRepository;
use App\Repositories\Reservation\ReservationRepository;
use App\Http\Requests\Branch\CreateBranch;

class BranchController extends Controller
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
        $this->middleware(['panel:admin']);
        $this->branchs = $branchs;
        $this->reservations = $reservations;
        $this->middleware('permission:branch.manage');
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
    public function create(
        Request $request, 
        CompanyRepository $companyRepository, 
        ProvinceRepository $provinceRepository,
        MethodPaymentRepository $methodPaymentRepository
    ){
        $edit = false;
        $companies = ['' => 'Seleccione empresa'] + $companyRepository->lists('name', 'id');
        $provinces = ['' => 'seleccionar provincia'] + $provinceRepository->lists('name', 'id');
        $payments = $methodPaymentRepository->all();
        $min_time = [
            '' => 'Hora inicio',
            6 => '06:00 AM',
            7 => '07:00 AM',
            8 => '08:00 AM',
            9 => '09:00 AM',
            10 => '10:00 AM',
            11 => '11:00 AM',
            12 => '12:00 M',
            13 => '01:00 PM',
            14 => '02:00 PM',
            15 => '03:00 PM',
            16 => '04:00 PM',
            17 => '05:00 PM',
            18 => '06:00 PM',
            19 => '07:00 PM',
            20 => '08:00 PM',
        ];
        $max_time = [
            '' => 'Hora fin',
            6 => '06:00 AM',
            7 => '07:00 AM',
            8 => '08:00 AM',
            9 => '09:00 AM',
            10 => '10:00 AM',
            11 => '11:00 AM',
            12 => '12:00 M',
            13 => '01:00 PM',
            14 => '02:00 PM',
            15 => '03:00 PM',
            16 => '04:00 PM',
            17 => '05:00 PM',
            18 => '06:00 PM',
            19 => '07:00 PM',
            20 => '08:00 PM',
        ];
        $status = [
            true => trans("app.Published"),
            false => trans("app.No Published")
        ];

        return view('branchs.create-edit', compact('edit', 'companies', 'provinces', 'status', 'min_time', 'max_time', 'payments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBranch $request)
    {
        $services = $request->services_name;
        $prices = $request->services_prices;
        $service_status = $request->services_status;
        $payments = $request->payments;
        $photos = $request->photos;

        $week = $request->week;
        $day_week = [0,1,2,3,4,5,6];
        $week_day = '';
        $week_diff = array_diff($day_week, $week);
        foreach ($week_diff as $day) {
            $week_day .= $day.',';
        }

        $data = [
            'company_id' => $request->company_id,
            'province_id' => $request->province_id, 
            'name' => $request->name,
            'address' => $request->address,
            'address_description' => $request->address_description,
            'services_description' => $request->services_description,
            'lat' => $request->lat,
            'lng' => $request->lng,
            'phone_one' => $request->phone_one,
            'phone_second' => $request->phone_second,
            'working_hours' => $request->working_hours,
            'week' => substr($week_day, 0, -1),
            'min_time' => $request->min_time,
            'max_time' => $request->max_time,
            'email' => $request->email,
            'reservation_web' => $request->reservation_web,
            'reservation_discount' => $request->reservation_discount,
            'percent_discount' => $request->percent_discount,
            'status' => $request->status
        ];

        $branch = $this->branchs->create($data);
        if ( $branch ) {

            if ( $services ) {
                foreach( $services as $key => $value ) {
                   $this->branchs->create_service([ 
                        'branch_office_id' => $branch->id,
                        'name' => $value,           
                        'price' => $prices[$key],
                        'status' => $service_status[$key]
                        ]
                    );
                }
            }

            if ( $payments ) {
                foreach( $payments as $key => $value ) {
                   $this->branchs->create_payment([ 
                        'branch_office_id' => $branch->id,
                        'method_payment_id' => $value,           
                        ]
                    );
                }
            }

            if ( $photos ) {
                foreach( $photos as $key => $file ) {
                    $date = new DateTime();
                    $ext = $file->extension();
                    $file_name = $date->getTimestamp().'.'.$ext;
                    
                    if($file){
                 
                        if($ext == 'png' ||$ext == 'jpg' || $ext == 'jpeg'){

                            if ($file->isValid()) {
                                \File::delete(public_path('uploads/photos').'/'.$file_name);
                                $path = $file->storeAs('uploads/photos', $file_name, 'locales');
                                $this->branchs->create_photo([ 
                                    'branch_office_id' => $branch->id,
                                    'name' => $file_name,           
                                    ]
                                );
                            }
                        }
                    }
                }
            }

            return redirect()->route('branch.index')->withSuccess('Local agregado');

        } else {

            return back()->withErrors(trans('app.error_again'));
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
    public function edit($id, Request $request, 
        CompanyRepository $companyRepository, 
        ProvinceRepository $provinceRepository,
        MethodPaymentRepository $methodPaymentRepository
    ){
        $edit = true;
        $branch = $this->branchs->find($id);
        $companies = ['' => 'Seleccione empresa'] + $companyRepository->lists('name', 'id');
        $provinces = ['' => 'seleccionar provincia'] + $provinceRepository->lists('name', 'id');
        $payments = $methodPaymentRepository->all();
        $min_time = [
            '' => 'Hora inicio',
            6 => '06:00 AM',
            7 => '07:00 AM',
            8 => '08:00 AM',
            9 => '09:00 AM',
            10 => '10:00 AM',
            11 => '11:00 AM',
            12 => '12:00 M',
            13 => '01:00 PM',
            14 => '02:00 PM',
            15 => '03:00 PM',
            16 => '04:00 PM',
            17 => '05:00 PM',
            18 => '06:00 PM',
            19 => '07:00 PM',
            20 => '08:00 PM',
        ];
        $max_time = [
            '' => 'Hora fin',
            6 => '06:00 AM',
            7 => '07:00 AM',
            8 => '08:00 AM',
            9 => '09:00 AM',
            10 => '10:00 AM',
            11 => '11:00 AM',
            12 => '12:00 M',
            13 => '01:00 PM',
            14 => '02:00 PM',
            15 => '03:00 PM',
            16 => '04:00 PM',
            17 => '05:00 PM',
            18 => '06:00 PM',
            19 => '07:00 PM',
            20 => '08:00 PM',
        ];
        $status = [
            true => trans("app.Published"),
            false => trans("app.No Published")
        ];
        $week = explode(',', $branch->week);
        $status_services = [
            true => 'Público', 
            false =>'No Público'
        ];

        return view('branchs.create-edit', compact(
            'branch', 
            'edit', 
            'week', 
            'companies', 
            'provinces', 
            'status', 
            'min_time', 
            'max_time', 
            'payments', 
            'status_services'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateBranch $request, $id, MethodPaymentRepository $methodPaymentRepository)
    {
        $services = $request->services_name;
        $payments = sisset($request->payment) ? $request->payment : [];
        $photos = $request->photos;
        $photos_up = isset($request->photos_id) ? $request->photos_id : [];

        $week = $request->week;
        $day_week = [0,1,2,3,4,5,6];
        $week_day = '';
        $week_diff = array_diff($day_week, $week);
        foreach ($week_diff as $day) {
            $week_day .= $day.',';
        }

        $data = [
            'company_id' => $request->company_id,
            'province_id' => $request->province_id, 
            'name' => $request->name,
            'address' => $request->address,
            'address_description' => $request->address_description,
            'services_description' => $request->services_description,
            'lat' => $request->lat,
            'lng' => $request->lng,
            'phone_one' => $request->phone_one,
            'phone_second' => $request->phone_second,
            'working_hours' => $request->working_hours,
            'week' => substr($week_day, 0, -1),
            'min_time' => $request->min_time,
            'max_time' => $request->max_time,
            'email' => $request->email,
            'reservation_web' => $request->reservation_web,
            'reservation_discount' => $request->reservation_discount,
            'percent_discount' => $request->percent_discount,
            'status' => $request->status
        ];

        $branch = $this->branchs->update($id, $data);

        if ( $branch ) {

            if ( $services ) {
                $services_old = $branch->services->toArray();
                $prices = $request->services_prices;
                $service_status = $request->services_status;
                $service_id = $request->service_id;
                $delete_service = array();
                foreach( $services as $key => $value ) {
                    
                    if((int)$service_id[$key] == 0) {
                        $this->branchs->create_service([ 
                            'branch_office_id' => $id,
                            'name' => $value,           
                            'price' => $prices[$key],
                            'status' => $service_status[$key]
                            ]
                        );
                    } else {
                        foreach ($services_old as $serv_old) {
                           if ( in_array($serv_old['id'], $service_id)  ) {
                               $this->branchs->update_service(
                                    (int)$service_id[$key],
                                    [ 
                                    'name' => $value,           
                                    'price' => $prices[$key],
                                    'status' => $service_status[$key]
                                    ]
                                );
                           } else {
                                $this->branchs->delete_service($serv_old['id']);
                           }
                        }
                    }      
                }
            }

            $payment_old = $branch->payment->toArray();
            foreach ($payments as $key => $value) {
                if (! in_array($value, $payment_old)  ) {
                    $this->branchs->delete_payment($value['id']);
                } else {
                    $this->branchs->create_payment([ 
                        'branch_office_id' => $id,
                        'method_payment_id' => $value,           
                        ]
                    );
                }
            }                     
            
            $photos_old = $branch->photos->toArray();
            foreach( $photos_old as $photo_old ) {
               if (! in_array($photo_old['id'], $photos_up)  ) {
                    \File::delete(public_path('uploads/photos').'/'.$photo_old['name']);
                    $this->branchs->delete_photo($photo_old['id']);
               }         
            }

            if ( $photos ) {
                foreach( $photos as $key => $file ) {
                    $date = new DateTime();
                    $ext = $file->extension();
                    $file_name = $date->getTimestamp().'.'.$ext;
                    
                    if($file){
                 
                        if($ext == 'png' ||$ext == 'jpg' || $ext == 'jpeg'){

                            if ($file->isValid()) {
                                \File::delete(public_path('uploads/photos').'/'.$file_name);
                                $path = $file->storeAs('uploads/photos', $file_name, 'locales');
                                $this->branchs->create_photo([ 
                                    'branch_office_id' => $branch->id,
                                    'name' => $file_name,           
                                    ]
                                );
                            }
                        }
                    }
                }
            }

            return redirect()->route('branch.index')->withSuccess('Local actualizado');

        } else {

            return back()->withErrors(trans('app.error_again'));
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
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function reservations($id, Request $request)
    {
        $local = $this->branchs->find($id);
        $reservations = $this->reservations->where('branch_office_id', $id)->paginate(10);

        if ( $request->ajax() ) {

            if (count($reservations) > 0) {
                return response()->json([
                    'success' => true,
                    'view' => view('branchs.list_reservations', compact('reservations'))->render(),
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => trans('app.no_records_found')
                ]);
            }
        }

        return view('branchs.reservations', compact('reservations', 'local'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function comments($id, Request $request)
    {
        $local = $this->branchs->find($id);

        return view('branchs.comments', compact('local'));
    }
}
