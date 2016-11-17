<?php

namespace App\Http\Requests\Users;

use App\Http\Requests\Request;

class AddCustomerRequest extends Request
{
    public function storableAttrs()
    {
        $role = 2;
        $storableAttrs = [
            'f_name' => $this->input('fname'),
            'l_name' => $this->input('lname'),
            'phone_number' => $this->input('phone_number'),
            'email' => $this->input('email'),
            'password' => bcrypt($this->input('password')),
            'address' => $this->input('address'),
            'role' => $role,

        ];

        return $storableAttrs;
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'images.max'=>'Images should not be greater than '.$this->maxImages,
            'g-recaptcha-response.google_recapcha' => 'you are a robot',
            'g-recaptcha-response.required' => 'Capcha field is required'
        ];
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'fname' => 'required|max:255',
            'lname' => 'required|max:255',
            'phone_number' => 'required|max:255',
            'address' => 'required|max:190',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'g-recaptcha-response'=>'required|google_recapcha'
        ];

        return $rules;
    }
}
