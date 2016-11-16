<?php

namespace App\Http\Requests\Franchise;

use App\Http\Requests\Request;

class FranchiseApproveRequest extends Request
{

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
        return [];
    }
}
