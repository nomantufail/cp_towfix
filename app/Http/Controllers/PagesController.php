<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\Vehicle\AddVehicleFormRequest;
use App\Repositories\VehicleTypesRepository;

class PagesController extends ParentController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function internalServerError()
    {
        return view('errors.503');
    }
}
