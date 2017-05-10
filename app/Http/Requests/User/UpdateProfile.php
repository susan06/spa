<?php

namespace App\Http\Requests\User;

use App\Http\Requests\RequestForm;

class UpdateProfile extends RequestForm
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
        $id = $this->route('profile');
        return [
            'name' => 'required|min:3',
            'lastname' => 'required|min:3',
            'phone' => 'required|numeric|min:9',
            'mobile' => 'required|numeric|min:9',
            'email' => 'required|email|max:255|unique:users,email,'.$id,
            'username' => 'max:100|unique:users,username,'.$id,
        ];
    }
}
