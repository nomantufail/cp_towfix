<?php

namespace App\Http\Requests\Vehicle;

use App\Models\Vehicle;
use App\Repositories\VehiclesRepository;

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
        $vehicle = (new VehiclesRepository(new Vehicle()))->findById($this->route()->parameter('vehicle_id'));
        return ($this->user()->can('edit','vehicles',$vehicle));
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
            'number_axles' => 'required'
        ];
    }
}
