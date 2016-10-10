<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\Vehicle\AddVehicleFormRequest;
use App\Repositories\VehiclesRepository;
use App\Repositories\VehicleTypesRepository;

class VehiclesController extends ParentController
{
    private $vehicleTypesRepo = null;
    private $vehiclesRepo = null;
    public function __construct(VehicleTypesRepository $vehicleTypesRepo, VehiclesRepository $vehiclesRepo)
    {
        parent::__construct();

        $this->vehicleTypesRepo = $vehicleTypesRepo;
        $this->vehiclesRepo = $vehiclesRepo;
    }

    public function showAddVehicleForm(AddVehicleFormRequest $request)
    {
        $data = [
            'vehicleTypes' => $this->vehicleTypesRepo->all()
        ];
        return view('vehicle.add-vehicle-form', $data);
    }

    public function storeVehicle(Requests\Vehicle\AddVehicleRequest $request)
    {
        try{
            $this->vehiclesRepo->store($request->storableAttrs());
            return redirect()->back()->with('success','Vehicle Stored Successfully');
        }catch (\Exception $e){
            return $this->handleInternalServerError($e->getMessage());
        }
    }

    public function listVehicles(Requests\Vehicle\ListVehiclesRequest $request)
    {
        try{
            return view('vehicle.list', ['vehicles'=> $this->vehiclesRepo->all(), 'vehicle_types'=>$this->vehicleTypesRepo->getIndexed()]);
        }catch (\Exception $e){
            return $this->handleInternalServerError($e->getMessage());
        }
    }
    public function delete(Requests\Vehicle\DeleteVehicleRequest $request)
    {
        try{
            $this->vehiclesRepo->delete($request->input('id'));
            return redirect()->back()->with('success','Vehicle deleted successfully');
        }catch (\Exception $e){
            return $this->handleInternalServerError($e->getMessage());
        }
    }
}
