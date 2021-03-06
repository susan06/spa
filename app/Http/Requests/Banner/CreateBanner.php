<?php

namespace App\Http\Requests\Banner;

use App\Http\Requests\RequestForm;

class CreateBanner extends RequestForm
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
            'image' => 'required|image|dimensions:min_width=800,min_height=400',
            'priority' => 'required||unique:banners,priority',
            'status' => 'required',
        ];
    }
}
