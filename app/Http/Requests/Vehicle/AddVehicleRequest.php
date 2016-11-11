<?php

namespace App\Http\Requests\Vehicle;

use Illuminate\Support\Facades\Auth;

class AddVehicleRequest extends VehicleRequest
{

    public function storableAttrs()
    {

        return [
            'vehicle_type_id' => $this->input('vehicle_type_id'),
            'customer_id' => Auth::user()->id,
            'make' => $this->input('make'),
            'model' => $this->input('model'),
            'year' => $this->input('year'),
            'year_purchased' => $this->input('year_purchased'),
            'last_service' => $this->input('last_service'),
            'next_service' => $this->input('next_service'),
            'registration_number' => $this->input('registration_number'),
            'registration_expiry' => $this->input('registration_expiry'),
            'engine_capacity' => $this->input('engine_capacity'),
            'number_axles' => $this->input('number_axles'),
            'details' => $this->input('details'),

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
            'vehicle_type_id' => 'required',
            'make' => 'required',
            'model' => 'required',
            'year' => 'required',
            'year_purchased' => 'required',
            'last_service' => 'required',
            'registration_number' => 'required',
            'registration_expiry' => 'required',
            'engine_capacity' => 'required',
            'number_axles' => 'required'

        ];
    }
}
