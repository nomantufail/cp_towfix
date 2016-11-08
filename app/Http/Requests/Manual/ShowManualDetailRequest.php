<?php

namespace App\Http\Requests\Manual;

use App\Http\Requests\Request;

class ShowManualDetailRequest extends Request
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
            'manual_id' => 'required|exists:manuals,id'
        ];
    }
}
