<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserChangeEmail extends FormRequest
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
            'email' => 'bail|required|email|unique:user'
        ];
    }
    public function messages()
    {
        return [
            'email.email'			 => 'Email adresa mora biti validna',
            'email.required'		 => 'Email adresa je obavezna',
            'email.unique'			 => 'Email adresa je zauzeta',
        ];
    }
}
