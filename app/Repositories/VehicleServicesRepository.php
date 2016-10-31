<?php
/**
 * Created by PhpStorm.
 * user: nomantufail
 * Date: 10/10/2016
 * Time: 10:13 AM
 */

namespace App\Repositories;


use App\Models\ServiceRequest;

class VehicleServicesRepository extends Repository
{
    public function __construct(ServiceRequest $vehicle)
    {
        $this->setModel($vehicle);
    }

    public function getServicesHistory($vehicleId){
        return $this->getModel()->where('vehicle_id',$vehicleId)->with('form')->get();
    }
}