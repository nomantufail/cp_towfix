<?php

namespace App\Http\Requests\Service;


class AddServiceRequest extends ServiceRequest
{

    public function getStorableAttrs()
    {
        return [
            'customer_id' => $this->user()->id,
            'vehicle_id' => $this->input('vehicle_id'),
            'franchise_id' => $this->input('franchise_id'),
            'work_type_id' => $this->input('work_type_id'),
            'suggested_date' => $this->input('suggested_date'),
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

        ];
    }
}
