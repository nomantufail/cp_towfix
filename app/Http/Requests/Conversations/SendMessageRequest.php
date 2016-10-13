<?php

namespace App\Http\Requests\Conversations;

use App\Repositories\UsersRepository;
use App\User;
use Illuminate\Support\Facades\Auth;

class SendMessageRequest extends ConversationsRequest
{


    public function messageAttrs()
    {
        return [
            'sender_id' => $this->user()->id,
            'receiver_id' => $this->input('receiver'),
            'message' => $this->input('message')
        ];
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->can("sendMessageTo", 'users', (new UsersRepository(new User()))->findById($this->input('receiver')));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
