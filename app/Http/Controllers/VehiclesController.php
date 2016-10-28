<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Vehicle;
use App\Repositories\VehicleServicesRepository;
use App\Repositories\VehiclesRepository;
use App\Repositories\VehicleTypesRepository;

class VehiclesController extends ParentController
{
    private $vehicleTypesRepo = null;
    private $vehiclesRepo = null;
    private $vehicleServicesRepo = null;
    public function __construct(VehicleTypesRepository $vehicleTypesRepo, VehiclesRepository $vehiclesRepo, VehicleServicesRepository $vehicleServicesRepository)
    {
        parent::__construct();

        $this->vehicleTypesRepo = $vehicleTypesRepo;
        $this->vehiclesRepo = $vehiclesRepo;
        $this->vehicleServicesRepo = $vehicleServicesRepository;
    }

    public function detail(Requests\Vehicle\VehicleDetailRequest $request)
    {
        return view('vehicle.detail', [
            'vehicle' => $this->vehiclesRepo->findById($request->route()->parameter('vehicle_id')),
            'services'=> $this->vehicleServicesRepo->getServicesHistory($request->route()->parameter('vehicle_id'))
        ]);
    }

    public function addDocument(Requests\Vehicle\AddVehicleServiceDocument $request)
    {
        dd('hi');
    }

    public function showAddVehicleForm(Requests\Vehicle\AddVehicleFormRequest $request)
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
            return redirect()->back()->with('success', 'Vehicle Stored Successfully');
        }catch (\Exception $e){
            return $this->handleInternalServerError($e->getMessage());
        }
    }

    public function editVehicleForm(Requests\Vehicle\EditVehicleRequest $request, $vehicle_id)
    {
        try{
            $data = [
                'vehicleTypes' => $this->vehicleTypesRepo->all(),
                'vehicle' => $this->vehiclesRepo->findById($vehicle_id)
            ];
            return view('vehicle.edit-vehicle-form', $data);
        }catch (\Exception $e){
            return $this->handleInternalServerError($e->getMessage());
        }
    }

    public function updateVehicle(Requests\Vehicle\UpdateVehicleRequest $request, $vehicle_id)
    {
        try{
            $this->vehiclesRepo->updateWhere(['id' => $vehicle_id], $request->updateableAttrs());
            return redirect()->back()->with('success','Vehicle#'.$vehicle_id.' updated Successfully');
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
            $this->vehiclesRepo->deleteById($request->input('id'));
            return redirect()->back()->with('success','Vehicle deleted successfully');
        }catch (\Exception $e){
            return $this->handleInternalServerError($e->getMessage());
        }
    }
}
