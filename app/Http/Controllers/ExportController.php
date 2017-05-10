<?php

namespace App\Http\Controllers;

use App;
use Excel;
use Illuminate\Http\Request;

class ExportController extends Controller
{

    /**
     * ExportController constructor.
     * @param    
     */
    public function __construct()
    {
        //
    }

    /**
     * Export Excel
     *
     */
    public function export($type, $status, Request $request)
    {
        $title_array[] = [];
        $register_array[] = [];
        
        $excel = App::make('excel');

        Excel::create('Reporte', function($excel) use($register_array) {
            $excel->sheet('Sheet 1', function($sheet) use($register_array) {
            $sheet->fromArray($register_array);
        });
        })->export($type);
    }

}
