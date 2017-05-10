<?php

namespace App\Http\Requests\User;

use App\Http\Requests\RequestForm;

class UpdateAvatar extends RequestForm
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
            'avatar' => 'required|image|dimensions:min_width=150,min_height=150'
        ];
    }
}
