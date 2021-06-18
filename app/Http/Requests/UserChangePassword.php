<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class UserChangePassword extends FormRequest
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
			'old_password'	 => 'bail|required',
			'password'		 => 'bail|required|string|min:1|confirmed',
		];
	}
	public function messages()
	{
		return [
			'old_password.required'	 => 'Stara lozinka je obavezna',
			'password.required'		 => 'Nova lozinka je obavezna',
			'password.confirmed'	 => 'Potvrda nove lozinke je netačna'
		];
	}
	public function withValidator($validator)
	{
		$validator->after(function ($validator) {
			if (!Hash::check($this->old_password, $this->user()->password)) {
				$validator->errors()->add('old_password','Stara lozinka je netačna');
			}
		});
		// return;
	}
}
