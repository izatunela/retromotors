<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormGallery extends FormRequest
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
            'title' 		=> 'bail|required|min:5|max:80',
            'description' 	=> 'bail|required|min:5|max:5000',
            'photosCount' 	=> 'bail|required|min:1'
        ];
    }

    public function messages()
    {
        return [
            'required'			 => 'Polje je obavezno',
            'title.min'			 => 'Previše kratak naslov',
            'title.max'			 => 'Unesite kraći naslov',
            'description.min'	 => 'Previše kratak opis',
            'description.max'	 => 'Unesite kraći opis',
            'photosCount.min'	 => 'Fotografije su obavezne'
        ];
    }
}