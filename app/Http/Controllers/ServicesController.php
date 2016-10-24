<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\Vehicle\AddVehicleFormRequest;
use App\Repositories\ServiceRequestsRepository;
use App\Repositories\VehiclesRepository;
use App\Repositories\VehicleTypesRepository;
use App\Repositories\WorkTypesRepository;
use Illuminate\Support\Facades\Auth;

class ServicesController extends ParentController
{
    protected $serviceRequestsRepo = null;
    protected $vehiclesRepo = null;
    protected $workTypesRepo = null;
    public function __construct(ServiceRequestsRepository $servicesRequestsRepository,
                                    VehiclesRepository $vehiclesRepository,
                                    WorkTypesRepository $workTypesRepository
                                )
    {
        parent::__construct();
        $this->serviceRequestsRepo = $servicesRequestsRepository;
        $this->vehiclesRepo = $vehiclesRepository;
        $this->workTypesRepo = $workTypesRepository;
    }

    public function showCreateRequestForm(Requests\Service\CreateServiceFormRequest $request)
    {
        $data = [
            'vehicles' => $this->vehiclesRepo->getByCustomerId(Auth::user()->id),
            'work_types' => $this->workTypesRepo->all(),
            'franchises' => $this->usersRepo->franchises(),
        ];
        return view('services.create-service-form', $data);
    }

    public function sendRequest(Requests\Service\AddServiceRequest $request)
    {
        $this->serviceRequestsRepo->store($request->getStorableAttrs());
        return redirect()->back()->with(['success'=>'request added successfully']);
    }


}
