<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Libs\Helpers\Helper;
use App\Models\ServiceRequest;
use App\Models\WorkType;
use App\Repositories\ServiceRequestsRepository;
use App\Repositories\WorkTypesRepository;
use Carbon\Carbon;
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
        $this->servicesWithPendingReminder()->each(function($service){
            $days_remaing_for_next_service = Carbon::createFromFormat('Y-m-d h:i:s',$service->vehicle->next_service)->diffInDays(Carbon::createFromFormat('Y-m-d',date('Y-m-d')));
            $next_service_date = Helper::towfixDateFormat($service->vehicle->next_service);
            $service->vehicle->owner->mail('home', $service);
        });
    }

    private function servicesWithPendingReminder()
    {
        $servicesTable = (new ServiceRequest())->getTable();
        return ServiceRequest::select(DB::raw("*"))
            ->select($servicesTable.".id as service_id", $servicesTable.".vehicle_id as vehicle_id")
            ->with(['vehicle' => function ($query) {
                $query->with('owner');
            }])
            ->leftJoin('vehicles', $servicesTable.".vehicle_id", '=', 'vehicles.id')
            ->Where(function ($query) {
                $query->where(DB::raw("DATEDIFF(vehicles.next_service,CURDATE())"),'=','30')
                    ->orWhere(DB::raw("DATEDIFF(vehicles.next_service,CURDATE())"),'=','7')
                    ->orWhere(DB::raw("DATEDIFF(vehicles.next_service,CURDATE())"),'=','1');
            })
            ->get();
    }

}
