<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\ServiceRequest;
use App\Models\WorkType;
use App\Repositories\ServiceRequestsRepository;
use App\Repositories\WorkTypesRepository;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CronsController extends ParentController
{

    private $services = null;
    public function __construct()
    {
        parent::__construct();
        $this->services = new ServiceRequestsRepository(new ServiceRequest());
    }

    public function run()
    {
        return $this->serviceReminder();
    }

    private function serviceReminder()
    {
        $servicesTable = (new ServiceRequest())->getTable();
        dd(ServiceRequest::select(DB::raw("*"))
            ->select($servicesTable.".id as service_id", $servicesTable.".vehicle_id as vehicle_id")
            ->with('vehicle')
            ->leftJoin('vehicles', $servicesTable.".vehicle_id", '=', 'vehicles.id')
            ->where(DB::raw("DATEDIFF(vehicles.next_service,GETDATE()"),'=','29')
            ->get()->toArray());
    }
}
