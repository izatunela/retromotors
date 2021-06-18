<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormComment extends FormRequest
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
            'body'      => 'bail|required|min:1|max:1500',
            'tlastreq'  => 'sometimes'
        ];
    }
    public function messages()
    {
        return [
            'body.required' => 'Prekratak komentar',
            'body.min'      => 'Prekratak komentar',
            'body.max'      => 'Predugačak komentar'
        ];
    }
}
