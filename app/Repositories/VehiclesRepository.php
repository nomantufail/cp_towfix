<?php
/**
 * Created by PhpStorm.
 * User: nomantufail
 * Date: 10/10/2016
 * Time: 10:13 AM
 */

namespace App\Repositories;


use App\Models\Vehicle;

class VehiclesRepository extends Repository
{
    public function __construct(Vehicle $vehicle)
    {
        $this->setModel($vehicle);
    }
}