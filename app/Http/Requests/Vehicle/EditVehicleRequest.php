<?php

namespace App\Http\Requests\Vehicle;


use App\Models\Vehicle;
use App\Repositories\VehiclesRepository;

class EditVehicleRequest extends VehicleRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $vehicle = (new VehiclesRepository(new Vehicle()))->findById($this->route()->parameter('vehicle_id'));
        if($vehicle == null)
            return false;
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
            'vehicle_id'=>'required|exists:vehicles,id'
        ];
    }
}
