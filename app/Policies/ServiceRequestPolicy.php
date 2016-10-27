<?php

namespace App\Policies;

use App\Models\ServiceRequest;
use App\User;

class ServiceRequestPolicy extends Policy
{

    public function __construct()
    {
        parent::__construct();
    }

    public function view(User $user , ServiceRequest $serviceRequest=null)
    {
        return ($user->isFranchise() || $user->isCustomer());
    }

    public function accept(User $user , ServiceRequest $serviceRequest=null)
    {
        return ($user->id != $serviceRequest->suggested_by && $serviceRequest->isPending() && ($serviceRequest->customer_id == $user->id || $serviceRequest->franchise_id == $user->id));
    }

    public function delete(User $user , ServiceRequest $serviceRequest=null)
    {
        return ($user->id == $serviceRequest->customer_id);
    }

    public function edit(User $user , ServiceRequest $serviceRequest=null)
    {
        return ($serviceRequest->customer_id == $user->id || $serviceRequest->franchise_id == $user->id);
    }
}
