<?php

namespace App\Http\Requests\Vehicle;

use App\Http\Requests\Vehicle\VehicleRequest;

class AddVehicleServiceDocument extends VehicleRequest
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
            'vehicle_id'=>'required|exists:vehicles,id'
        ];
    }
}
