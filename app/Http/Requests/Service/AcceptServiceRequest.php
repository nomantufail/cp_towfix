<?php

namespace App\Http\Requests\Service;


class AcceptServiceRequest extends ServiceRequest
{

    public function getUpdateableAttrs()
    {
        return [
            'status' => 1,
        ];
    }
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

        ];
    }
}
