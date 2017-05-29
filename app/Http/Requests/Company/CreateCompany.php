<?php

namespace App\Http\Requests\Company;

use App\Http\Requests\RequestForm;

class CreateCompany extends RequestForm
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
            'name' => 'required',
            'owner_id' => 'required',
        ];
    }
}
