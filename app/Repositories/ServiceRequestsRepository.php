<?php
/**
 * Created by PhpStorm.
 * User: nomantufail
 * Date: 10/10/2016
 * Time: 10:13 AM
 */

namespace App\Repositories;


use App\Models\ServiceRequest;

class ServiceRequestsRepository extends Repository
{
    public function __construct(ServiceRequest $vehicle)
    {
        $this->setModel($vehicle);
    }
}