<?php

namespace App\Http\Requests\Franchise;

use App\Http\Requests\Request;

class UpdateFranchiseRequest extends Request
{

    public function updateableAttrs()
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
            $storableAttrs['l_name'] = $names[1];
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return

            $rules = [
                'name' => 'required|max:255',
                'phone_number' => 'required|max:255',
                'address' => 'required',
                'email' => 'required|email|email|unique:users,email,'.$this->route()->parameter('franchise_id').'|max:255',
                'password' => 'required|min:6|confirmed',
        ];
    }
}
