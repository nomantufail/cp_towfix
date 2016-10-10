<?php

namespace App\Http\Requests\Vehicle;

class UpdateVehicleRequest extends VehicleRequest
{

    public function updateableAttrs()
    {
        return [
            'vehicle_type_id' => $this->input('vehicle_type_id')
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
            //
        ];
    }
}
