<?php

namespace App\Http\Requests\Service;


use App\Repositories\ServiceRequestsRepository;
use App\Models\ServiceRequest as RequestModel;

class UpdateServiceRequest extends ServiceRequest
{

    public function getUpdateableAttrs()
    {
        return [
            'suggested_date' => $this->input('suggested_date'),
            'message' => $this->input('message'),
            'suggested_by' => $this->user()->id,
            'status' => 0
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $request = (new ServiceRequestsRepository(new RequestModel()))->findById($this->route()->parameter('request_id'));
        return ($this->user()->can('edit','serviceRequest',$request));
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
