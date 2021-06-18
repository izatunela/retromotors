<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormTruck extends FormRequest
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
			'country'				=>'bail|required',
			'city'					=>'bail|required',
			'brand'					=>'bail|required|exists:brands_truck,name',
			'custom_brand'			=>'bail|required|sometimes',
			'model'					=>'bail|required',
			'type'					=>'bail|required',
			'vehicle_registration'	=>'bail|required',
			'condition'				=>'bail|required',
			'manufacture_year'		=>'bail|required',
			'transmission'			=>'bail|required',
			'fuel'					=>'bail|required',
			'color'					=>'bail|required',
			'axle'					=>'bail|required',
			'capacity'				=>'bail|required',
			'kilometerage'			=>'bail|required',
			'volume'				=>'bail|required',
			'power'					=>'bail|required',
			'price'					=>'bail|required|sometimes|integer|min:0',
			'description'			=>'bail|required|min:5',
            'contact_phone'         =>'bail|required|regex:/[\d\s\-\\\\\/\.\+]+/|min:5|max:30',
			'photosCount'			=>'bail|required|integer|min:1|max:15'
		];
	}
	public function messages()
	{
		return [
			'required'			 	=> 'Polje je obavezno',
			'description.min'	 	=> 'Previše kratak opis',
			'photosCount.min'	 	=> 'Fotografije su obavezne',
			'contact_phone.regex'   => 'Format nije validan',
			'contact_phone.min'     => 'Broj telefona: min 6 cifara',
			'contact_phone.max'     => 'Broj telefona: max 30 cifara'
		];
	}
}
