<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegistration extends FormRequest
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
            'name'		 => 'bail|required|regex:/^[A-Za-zČčĆćĐđŠšŽžабвгдђежзијклљмнњопрстћуфхцчџшАБВГДЂЕЖЗИЈКЛЉМНЊОПРСТЋУФХЦЧЏШ][A-Za-zČčĆćĐđŠšŽžабвгдђежзијклљмнњопрстћуфхцчџшАБВГДЂЕЖЗИЈКЛЉМНЊОПРСТЋУФХЦЧЏШ0-9]*$/i|string|unique:user|max:30|min:3',
            // 'name'		 => 'bail|required|regex:/^[[:alpha:]]/i|alpha_num|string|unique:user|max:30|min:3',
            'email'		 => 'bail|required|string|email|unique:user|max:255',
            'password'	 => 'bail|required|string|min:1|confirmed'
        ];
    }
    public function messages()
    {
        return [
            'name.required'			 => 'Ime je obavezno',
            'name.unique'			 => 'Ime je zauzeto',
            'name.min'				 => 'Previše kratko ime',
            'name.max'				 => 'Unesite kraće ime',
            'name.regex'			 => 'Ime mora počinjati slovom i sme sadržati samo slova i brojeve',
            'email.email'			 => 'Email adresa mora biti validna',
            'email.required'		 => 'Email adresa je obavezna',
            'email.unique'			 => 'Email adresa je zauzeta',
            'email.max'			     => 'Email adresa je predugačka',
            'password.required'		 => 'Lozinka je obavezna',
            'password.confirmed'	 => 'Lozinke se ne poklapaju',
            'password.min'	         => 'Lozinka mora imati najmanje 8 karaktera',
        ];
    }
}