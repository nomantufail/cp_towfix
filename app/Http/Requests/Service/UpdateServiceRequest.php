<?php

namespace App\Http\Requests\Service;


class UpdateServiceRequest extends ServiceRequest
{

    public function getUpdateableAttrs()
    {
        return [
            'suggested_date' => $this->input('suggested_date'),
            'message' => $this->input('message'),
            'suggested_by' => $this->user()->id
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
            'request_id' => 'required|exists:cust_vehicle_srv_reqs,id'
        ];
    }
}
