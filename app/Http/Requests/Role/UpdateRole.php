<?php

namespace App\Http\Requests\Role;

use App\Http\Requests\RequestForm;

class UpdateRole extends RequestForm
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
        $id = $this->route('role');
        return [
           'display_name' => 'required',
           'description' => 'required',
           'name' => 'required|unique:roles,name,'.$id
        ];
    }
}
