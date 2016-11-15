<?php

namespace App\Http\Requests\Vehicle;


class AddVehicleServiceDocumentRequest extends VehicleRequest
{
    public function document()
    {

        return collect($this->input('document'))->toJson();
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
            'vehicle_id'=>'required|exists:vehicles,id',
            'next_service'=>'required'
        ];
    }
}
