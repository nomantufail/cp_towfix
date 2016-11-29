<?php

namespace App\Http\Requests\Service;
use DateTime;


class AddServiceRequest extends ServiceRequest
{

    public function getStorableAttrs()
    {
        $date = ($this->input('suggested_date'));
        return [
            'customer_id' => $this->user()->id,
            'vehicle_id' => $this->input('vehicle_id'),
            'franchise_id' => $this->input('franchise_id'),
            'work_type' => $this->input('work_type'),
            'suggested_date' => $date,
            'suggested_by' => $this->user()->id,
            'message' => ''
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

            'vehicle_id' => 'required',
            'franchise_id' => 'required',
            'work_type' => 'required',
            'suggested_date' => 'required',
        ];
    }
}
