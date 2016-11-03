<?php

namespace App\Policies;

use App\Models\Manual;
use App\User;

class ManualsPolicy extends Policy
{

    public function __construct()
    {
        parent::__construct();
    }

    public function view(User $user , Manual $manual=null)
    {
        return ($user->isAdmin() || $user->isFranchise());
    }
}
