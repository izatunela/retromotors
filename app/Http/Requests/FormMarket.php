<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormMarket extends FormRequest
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
            'country'			=>'bail|required',
            'city'				=>'bail|required',
            'price'				=>'bail|required',
            'description'		=>'bail|required',
            'photosCount'		=>'bail|required|integer|min:1',
        	//Automobile//Motorcycle//Truck//Parts
            'brand'				=>'bail|required|sometimes',
        	//Automobile//Motorcycle//Truck
            'model'				=>'bail|required|sometimes',
            'manufacture_year'	=>'bail|required|sometimes',
            'transmission'		=>'bail|required|sometimes',
            'color'				=>'bail|required|sometimes',
            'kilometerage'		=>'bail|required|sometimes',
            'volume'			=>'bail|required|sometimes',
            'power'				=>'bail|required|sometimes',
            //Automobile//Truck
            'fuel'				=>'bail|required|sometimes',
            //Automobile
            'drivetrain'		=>'bail|required|sometimes',
            //Motorcycle
            'cylinder'			=>'bail|required|sometimes',
            //Truck
            'axle'				=>'bail|required|sometimes',
            'capacity'			=>'bail|required|sometimes',
            //Parts//Equipment
            'title'				=>'bail|required|sometimes', //ubaci minimalni broj simbola
            //Parts
            'vehicle_category'	=>'bail|required|sometimes',
        ];
    }
    public function messages()
    {
        return [
            'required'	 => 'Polje je obavezno',
            'min'		 => 'Minimalno jedna fotografija'
        ];
    }
}
