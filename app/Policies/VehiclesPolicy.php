<?php

namespace App\Policies;

use App\User;
use App\Models\Vehicle;

class VehiclesPolicy extends Policy
{

    public function __construct()
    {
        parent::__construct();
    }

    public function view(User $user , Vehicle $vehicle=null)
    {
        return true;
    }
}
