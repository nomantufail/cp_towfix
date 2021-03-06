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

    public function add(User $user , Vehicle $vehicle = null)
    {
        return ($user->isCustomer());
    }
    public function edit(User $user , Vehicle $vehicle)
    {
        return ($user->id == $vehicle->customer_id || $user->isAdmin() || $user->isFranchise());
    }

    public function delete(User $user , Vehicle $vehicle)
    {
        return ($user->id == $vehicle->customer_id || $user->isAdmin());
    }
}
