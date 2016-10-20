<?php

namespace App\Http\Requests\NewsLetter;

use App\Http\Requests\Request;

class UpdateNewsletterRequest extends Request
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
            'newsletter_id' => 'required|exists:newsletters,id',
            'name' => 'required',
            'image'=>'image|max:2000'
        ];
    }
}
