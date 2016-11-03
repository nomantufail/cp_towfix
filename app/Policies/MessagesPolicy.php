<?php

namespace App\Policies;

use App\Models\Message;
use App\User;

class MessagesPolicy extends Policy
{

    public function __construct()
    {
        parent::__construct();
    }

    public function view(User $user , Message $message=null)
    {
        return ($user->isFranchise() || $user->isCustomer());
    }
}
