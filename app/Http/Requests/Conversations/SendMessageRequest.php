<?php

namespace App\Http\Requests\Conversations;

use App\Repositories\UsersRepository;
use App\User;
use Illuminate\Support\Facades\Auth;

class SendMessageRequest extends ConversationsRequest
{

    protected $maxImages = 10;
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
        try{
            return Auth::user()->can("sendMessageTo", 'users', (new UsersRepository(new User()))->findById($this->input('receiver')));
        }catch (\Exception $e){
            return false;
        }
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
            'images'=>'max:'.$this->maxImages,
        ];

        foreach(range(0, (count($this->file('images')) - 1)) as $index) {
            $rules['images.' . $index] = 'image|max:2000';
        }
        return $rules;
    }

}
