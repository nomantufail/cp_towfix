<?php

namespace App\Http\Requests\Vehicle;

use App\Models\Vehicle;
use App\Repositories\VehiclesRepository;

class UpdateVehicleRequest extends VehicleRequest
{

    public function updateableAttrs()
    {
        $attrs = [
            'vehicle_type' => $this->input('vehicle_type'),
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
        if($this->input('customer_id') != null){
            $attrs['customer_id'] = $this->input('customer_id');
        }
        return $attrs;
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
            'vehicle_type' => 'required',
            'make' => 'required|max:190',
            'model' => 'required|max:190',
            'year' => 'required',
            'year_purchased' => 'required',
            'last_service' => 'required',
            'registration_number' => 'required',
            'registration_expiry' => 'required|max:190',
            'engine_capacity' => 'required|max:190',
            'number_axles' => 'required'
        ];
    }
}
