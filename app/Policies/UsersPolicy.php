<?php

namespace App\Policies;

use App\User;

class UsersPolicy extends Policy
{
    public function __construct()
    {
        parent::__construct();
    }

    public function sendMessageTo(User $user , User $subject)
    {
        if($user->isCustomer() && $subject->isFranchise())
            return true;
        else if($user->isFranchise() && $subject->isCustomer())
            return true;
        else return false;
    }

    public function delete(User $user , User $subject)
    {
        return $user->isAdmin();
    }

    public function edit(User $user , User $subject)
    {
        if($user->isAdmin())
            return true;

        return ($user->id == $subject->id);
    }
}
