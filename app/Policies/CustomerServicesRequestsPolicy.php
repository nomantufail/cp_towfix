<?php

namespace App\Policies;

use App\Models\CustomerServiceRequest;
use App\User;

class CustomerServicesRequestsPolicy extends Policy
{

    public function __construct()
    {
        parent::__construct();
    }

    public function view(User $user , CustomerServiceRequest $customerServiceRequest=null)
    {
        return ($user->isFranchise());
    }
}
