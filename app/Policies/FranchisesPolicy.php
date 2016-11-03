<?php

namespace App\Policies;

use App\User;

class FranchisesPolicy extends Policy
{

    public function __construct()
    {
        parent::__construct();
    }

    public function view(User $user , User $franchise=null)
    {
        return ($user->isAdmin());
    }
}
