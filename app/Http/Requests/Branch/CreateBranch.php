<?php

namespace App\Http\Requests\Branch;

use Illuminate\Foundation\Http\FormRequest;

class CreateBranch extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'company_id' => 'required',
            'province_id' => 'required', 
            'name' => 'required',
            'address' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'phone_one' => 'required',            
            'working_hours' => 'required',
            'week' => 'required',
            'min_time' => 'required',
            'max_time' => 'required',
            'email' => 'required|email',
            'status' => 'required'
        ];
    }
}
