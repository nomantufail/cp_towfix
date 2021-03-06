<?php

namespace App\Http\Requests\Users;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class ShowAddCustomerFormRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return (Auth::user()->can('add','customers'));
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
