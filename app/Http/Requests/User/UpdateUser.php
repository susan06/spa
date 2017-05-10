<?php

namespace App\Http\Requests\User;

use App\Http\Requests\RequestForm;

class UpdateUser extends RequestForm
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
        $id = $this->route('user');
        return [
            'name' => 'required|min:3',
            'lastname' => 'required|min:3',
            'status' => 'required',
            'phone' => 'numeric',
            'mobile' => 'numeric',
            'role' => 'required|exists:roles,id',
            'birthday' => 'date',
            'email' => 'required|email|unique:users,email,'.$id
        ];
    }
}
