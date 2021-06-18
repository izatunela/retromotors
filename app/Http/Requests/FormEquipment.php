<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormEquipment extends FormRequest
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
            'title'			=>'bail|required|min:5', //ubaci minimalni broj simbola
            'country'		=>'bail|required',
            'city'			=>'bail|required',
            'condition'		=>'bail|required',
            'price'			=>'bail|required|sometimes|integer|min:0',
            'description'	=>'bail|required|min:5',
            'contact_phone' =>'bail|required|regex:/[\d\s\-\\\\\/\.\+]+/|min:5|max:30',
            'photosCount'	=>'bail|required|integer|min:1|max:15'
        ];
    }
    public function messages()
    {
        return [
            'required'			    => 'Polje je obavezno',
        	'title.min'			    => 'Previše kratak naslov',
        	'description.min'	    => 'Previše kratak opis',
            'photosCount.min'	    => 'Fotografije su obavezne',
            'contact_phone.regex'   => 'Format nije validan',
            'contact_phone.min'     => 'Broj telefona: min 6 cifara',
            'contact_phone.max'     => 'Broj telefona: max 30 cifara'
        ];
    }
}
