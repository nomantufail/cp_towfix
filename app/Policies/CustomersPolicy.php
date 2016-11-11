<?php

namespace App\Policies;

use App\User;

class CustomersPolicy extends Policy
{

    public function __construct()
    {
        parent::__construct();
    }

    public function view(User $user , User $customer=null)
    {
        return ($user->isFranchise() || $user->isAdmin());
    }

    public function seeAll(User $user , User $customer=null)
    {
        return ($user->isFranchise() || $user->isAdmin());
    }

}
