<?php

namespace App\Http\Requests\Tour;

use App\Http\Requests\RequestForm;

class CreateTour extends RequestForm
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
            'branch_office_id' => 'required',
            'title' => 'required',
            'date_start' => 'required',
            'date_end' => 'required',
            'view_start' => 'required',
            'view_end' => 'required',
            'description' => 'required',
            'view' => 'required',
        ];
    }
}
