<?php

namespace App\Http\Requests\Vehicle;

use Illuminate\Support\Facades\Auth;

class AddVehicleRequest extends VehicleRequest
{

    public function storableAttrs()
    {
        return [
            'vehicle_type_id' => $this->input('vehicle_type_id'),
            'customer_id' => Auth::user()->id
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
