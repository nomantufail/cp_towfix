<?php

namespace App\Policies;

use App\User;

class OnlineStorePolicy extends Policy
{

    public function __construct()
    {
        parent::__construct();
    }

    public function view(User $user , $onlineStore=null)
    {
        return ($user->isCustomer());
    }
}
