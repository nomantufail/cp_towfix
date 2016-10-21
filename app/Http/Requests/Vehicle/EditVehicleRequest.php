<?php

namespace App\Http\Requests\Vehicle;


class EditVehicleRequest extends VehicleRequest
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
            'vehicle_type_id' => 'required',
            'make' => 'required',
            'model' => 'required',
            'year' => 'required',
            'year_purchased' => 'required',
            'last_service' => 'required',
            'next_service' => 'required',
            'registration_number' => 'required',
            'registration_expiry' => 'required',
            'engine_capacity' => 'required',
            'number_axles' => 'required',
            'details' => 'required'
        ];
    }
}
