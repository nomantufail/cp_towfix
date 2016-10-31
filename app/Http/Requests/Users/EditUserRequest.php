<?php

namespace App\Http\Requests\Users;


use App\Http\Requests\Request;
use App\Repositories\UsersRepository;
use App\User;

class EditUserRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        try{
            $user = (new UsersRepository(new User()))->findById($this->route()->parameter('user_id'));
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
            "user_id" => 'required|exists:users,id'
        ];
    }
}
