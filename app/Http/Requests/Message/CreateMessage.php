<?php

namespace App\Http\Requests\Message;

use App\Http\Requests\RequestForm;

class CreateMessage extends RequestForm
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
            'subject' => 'required',
            'description' => 'required',
        ];
    }
}
