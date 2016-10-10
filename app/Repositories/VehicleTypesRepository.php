<?php
/**
 * Created by PhpStorm.
 * User: nomantufail
 * Date: 10/10/2016
 * Time: 10:13 AM
 */

namespace App\Repositories;


use App\Models\VehicleType;

class VehicleTypesRepository extends Repository
{
    public function __construct(VehicleType $vehicleType)
    {
        $this->setModel($vehicleType);
    }

    public function getIndexed()
    {
        $indexedTypes = [];
        $types = $this->all();
        foreach($types as $type)
        {
            $indexedTypes[$type->id] = $type;
        }
        return $indexedTypes;
    }
}