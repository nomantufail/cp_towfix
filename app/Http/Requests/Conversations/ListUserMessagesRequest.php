<?php

namespace App\Http\Requests\Conversations;

use App\Repositories\UsersRepository;
use App\User;
use Illuminate\Support\Facades\Auth;

class ListUserMessagesRequest extends ConversationsRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->can("sendMessageTo", 'users', (new UsersRepository(new User()))->findById($this->route()->parameter('user_id')));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => 'required'
        ];
    }

    public function all()
    {
        return array_replace_recursive(
            parent::all(),
            $this->route()->parameters()
        );
    }
}
