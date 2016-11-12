<?php

namespace App\Http\Requests\Franchise;

use App\Http\Requests\Request;

class AddFranchiseRequest extends Request
{
    public function storableAttrs()
    {
        $names = explode(" ", $this->input('name'));
        $role = 2;

        $storableAttrs = [
            'f_name' => $names[0],
            'phone_number' => $this->input('phone_number'),
            'email' => $this->input('email'),
            'password' => bcrypt($this->input('password')),
            'address' => $this->input('address'),
            'role' => $role,

        ];
        if(count($names) > 1)
        {
            (array_shift($names));
            $names = implode(" " , $names);
            $storableAttrs['l_name'] = $names;
        }
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
            'images.max'=>'Images should not be greater than '.$this->maxImages
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
            'name' => 'required|max:255',
            'phone_number' => 'required|max:255',
            'address' => 'required|max:190',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ];

        return $rules;
    }
}
