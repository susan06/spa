<?php

namespace App\Http\Requests\Permission;

use App\Http\Requests\RequestForm;

class CreatePermission extends RequestForm
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
            'display_name' => 'required',
            'description' => 'required',
            'name' => 'required|unique:permissions'
        ];
    }
}
