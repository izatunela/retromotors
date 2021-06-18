<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserProfile extends FormRequest
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
            'phone'     => 'bail|nullable|string|regex:/^\d+$/|min:6|max:30',
            'city'      => 'bail|nullable|string|alpha|max:50|min:2',
            'country'   => 'bail|nullable|string|alpha|max:50|min:2'
        ];
    }
    public function messages()
    {
        return [
            'phone.regex'   => 'Broj telefona sme sadržati samo cifre',
            'phone.min'     => 'Broj telefona: min 6 cifara',
            'phone.max'     => 'Broj telefona: max 30 cifara',
            'city.alpha'    => 'Ime grada sme sadržati samo slova',
            'city.min'      => 'Ime grada: min 2 slova',
            'city.max'      => 'Ime grada: max 50 slova',
            'country.alpha' => 'Ime države sme sadržati samo slova',
            'country.min'   => 'Ime države: min 2 slova',
            'country.max'   => 'Ime države: max 50 slova',
        ];
    }
}
