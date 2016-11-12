<?php

namespace App\Http\Requests\Users;


use App\Http\Requests\Request;
use App\Repositories\UsersRepository;
use App\User;

class UpdateCustomerRequest extends Request
{
    public function updateableAttrs()
    {
        return [
            'f_name' => $this->input('fName'),
            'l_name' => $this->input('lName'),
            'email' => $this->input('email'),
            'phone_number' => $this->input('phoneNumber'),
            'password' => bcrypt($this->input('password')),
            'address' => $this->input('address')
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        try{
            $user = (new UsersRepository(new User()))->findById($this->route()->parameter('customer_id'));
            return ($this->user()->can('edit','users',$user));
        }catch(\Exception $e){
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'customer_id' => 'required|exists:users,id',
            'fName' => 'required|max:190',
            'lName' => 'required|max:190',
            'address' => 'required|max:190',
            'email' => 'required|email|email|unique:users,email,'.$this->route()->parameter('customer_id').'|max:255',
            'password' => 'required|min:6|confirmed',
        ];
    }
}
