<?php

namespace App\Http\Requests\Faq;

use App\Http\Requests\RequestForm;

class CreateFaq extends RequestForm
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
            'question' => 'required',
            'answer' => 'required',
            'status' => 'required',
        ];
    }
}
