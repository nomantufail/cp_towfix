<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Vehicle;
use App\Repositories\ServiceRequestFormsRepository;
use App\Repositories\VehicleServicesRepository;
use App\Repositories\VehiclesRepository;
use App\Repositories\VehicleTypesRepository;
use Illuminate\Support\Facades\Auth;

class VehiclesController extends ParentController
{
    private $vehicleTypesRepo = null;
    private $vehiclesRepo = null;
    private $vehicleServicesRepo = null;
    private $serviceRequestFormsRepo = null;
    public function __construct(VehicleTypesRepository $vehicleTypesRepo, VehiclesRepository $vehiclesRepo,
                                VehicleServicesRepository $vehicleServicesRepository, ServiceRequestFormsRepository $serviceRequestFormsRepository)
    {
        parent::__construct();

        $this->vehicleTypesRepo = $vehicleTypesRepo;
        $this->vehiclesRepo = $vehiclesRepo;
        $this->vehicleServicesRepo = $vehicleServicesRepository;
        $this->serviceRequestFormsRepo = $serviceRequestFormsRepository;
    }

    public function detail(Requests\Vehicle\VehicleDetailRequest $request)
    {
        return view('vehicle.detail', [
            'vehicle' => $this->vehiclesRepo->findWithDetails($request->route()->parameter('vehicle_id')),
            'services'=> $this->vehicleServicesRepo->getServicesHistory($request->route()->parameter('vehicle_id'))
        ]);
    }

    public function addDocument(Requests\Vehicle\AddVehicleServiceDocumentRequest $request)
    {
        $this->vehiclesRepo->updateWhere(['id'=>$request->route()->parameter('vehicle_id')], ['next_service'=>$request->input('next_service')]);
        $this->serviceRequestFormsRepo->store([
            'cust_vehicle_srv_reqs_id'=>$request->input('cust_vehicle_srv_reqs_id'),
            'document'=>$request->document()
        ]);
        return redirect()->back()->with(['success'=>'Document added successfully !']);
    }

    public function updateDocument(Requests\Vehicle\UpdateVehicleServiceDocumentRequest $request)
    {
        $this->vehiclesRepo->updateWhere(['id'=>$request->route()->parameter('vehicle_id')], ['next_service'=>$request->input('next_service')]);
        $this->serviceRequestFormsRepo->updateWhere(['cust_vehicle_srv_reqs_id'=>$request->input('cust_vehicle_srv_reqs_id'),],['document'=>$request->document()]);
        return redirect()->back()->with(['success'=>'Document updated successfully !']);
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
                'vehicle' => $this->vehiclesRepo->findById($vehicle_id),
                'customers' => $this->usersRepo->customers()
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
            $vehicles = (Auth::user()->isCustomer())?$this->vehiclesRepo->getByCustomerId(Auth::user()->id):$this->vehiclesRepo->all();
            return view('vehicle.list', ['vehicles'=> $vehicles, 'vehicle_types'=>$this->vehicleTypesRepo->getIndexed()]);
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
