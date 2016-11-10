<?php

namespace App\Http\Requests\Users;


use App\Http\Requests\Request;
use App\Repositories\UsersRepository;
use App\User;

class ShowCustomerDetailsRequest extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = (new UsersRepository(new User()))->findById($this->route()->parameter('customer_id'));
        if($user == null || !$user->isCustomer())
            return false;

        return ($this->user()->can('view','customers'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'customer_id'=>'required|exists:users,id'
        ];
    }
}
