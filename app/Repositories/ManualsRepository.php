<?php
/**
 * Created by PhpStorm.
 * user: nomantufail
 * Date: 10/10/2016
 * Time: 10:13 AM
 */

namespace App\Repositories;


use App\Models\Manual;

class ManualsRepository extends Repository
{
    public function __construct(Manual $manual)
    {
        $this->setModel($manual);
    }

    public function getWithDetails()
    {
        return $this->getModel()->with('images')->get();
    }

    public function findFullById($manualId)
    {
        return $this->getModel()->with('images')->where('id',$manualId)->first();
    }
}