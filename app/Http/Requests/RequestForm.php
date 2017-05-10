<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

abstract class RequestForm extends FormRequest
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
     * Get the failed validation response for the request
     *
     * @param array $errors
     * @return JSON
     */
    public function response(array $errors)
    {
        if ( $this->ajax() ) {

            return response()->json([
                'success' => false,
                'validator' => true,
                'message' => $errors
            ]);
        }

        return $this->redirector->to($this->getRedirectUrl())
             ->withInput($this->except($this->dontFlash))
             ->withErrors($errors);
    }
}
