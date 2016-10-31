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

    public function listServices(Requests\Service\ListServiceRequests $request)
    {
        $data = [
            'requests' => ($request->user()->isCustomer())?$this->serviceRequestsRepo->getCustomerRequests($request->user()->id):$this->serviceRequestsRepo->getFranchiseRequests($request->user()->id)
        ];
        return view('services.list-services',$data);
    }

    public function sendRequest(Requests\Service\AddServiceRequest $request)
    {
        $this->serviceRequestsRepo->store($request->getStorableAttrs());
        return redirect()->back()->with(['success'=>'request added successfully']);
    }

    public function showEditRequestForm(Requests\Service\ShowEditRequestFormRequest $request)
    {
        return view('services.edit-request', ['request'=>$this->serviceRequestsRepo->findById($request->route()->parameter('request_id'))]);
    }

    public function updateRequest(Requests\Service\UpdateServiceRequest $request)
    {
        $this->serviceRequestsRepo->updateWhere(['id'=>$request->route()->parameter('request_id')], $request->getUpdateableAttrs());
        return redirect()->route('service_requests')->with(['success'=>'request updated successfully']);
    }

    public function AcceptRequest(Requests\Service\AcceptServiceRequest $request)
    {
        $this->serviceRequestsRepo->updateWhere(['id'=>$request->route()->parameter('request_id')], $request->getUpdateableAttrs());
        return redirect()->back()->with(['success'=>'request Accepted successfully']);
    }

    public function DeleteRequest(Requests\Service\DeleteServiceRequest $request)
    {
        $this->serviceRequestsRepo->deleteById($request->route()->parameter('request_id'));
        return redirect()->back()->with(['success'=>'request Deleted successfully']);
    }

}
