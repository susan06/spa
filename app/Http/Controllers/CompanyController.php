<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Company\CompanyRepository;
use App\Http\Requests\Company\CreateCompany;
use App\Repositories\User\UserRepository;

class CompanyController extends Controller
{
    /**
     * @var CompanyRepository
     */
    private $companies;

    /**
     * CompanyController constructor.
     * @param CompanyRepository $companies
     */
    public function __construct(CompanyRepository $companies)
    {
        $this->middleware('auth');
        $this->middleware('locale'); 
        $this->middleware('timezone'); 
        $this->companies = $companies;
        $this->middleware(['panel:admin']);
    }

   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $companies = $this->companies->paginate(10, $request->search);
        if ( $request->ajax() ) {

            if (count($companies)) {
                return response()->json([
                    'success' => true,
                    'view' => view('companies.list', compact('companies'))->render(),
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => trans('app.no_records_found')
                ]);
            }
        }

        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, UserRepository $userRepository)
    {
        $edit = false;
        $owners = $userRepository->list_owner();

        if ( $request->ajax() ) {
            return response()->json([
                'success' => true,
                'view' => view('companies.create-edit', compact('edit', 'owners'))->render()
            ]);
        } 

        return view('companies.create-edit', compact('edit', 'owners'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCompany $request)
    {
        $company = $this->companies->create($request->all());
        if ( $company ) {
            
            return response()->json([
                'success' => true,
                'message' => trans('app.company_created')
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
    public function edit($id, UserRepository $userRepository)
    {
        $edit = true;
        $owners = $userRepository->list_owner();

        if ( $company = $this->companies->find($id) ) {
            return response()->json([
                'success' => true,
                'view' => view('companies.create-edit', compact('company', 'edit', 'owners'))->render()
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
    public function update(CreateCompany $request, $id)
    {
        $company = $this->companies->update(
            $id, 
            $request->only('name','owner_id')
        );
        if ( $company ) {
            
            return response()->json([
                'success' => true,
                'message' => trans('app.company_updated')
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
        $company = $this->companies->find($id);
        if ( $this->companies->delete($id) ) {
            
            return response()->json([
                'success' => true,
                'message' => trans('app.company_deleted')
            ]);
        } else {
            return response()->json([
                'success'=> false,
                'message' => trans('app.error_again')
            ]);
        }
    }
}
