<?php

namespace App\Policies;

use App\Models\Order;
use App\User;

class OrdersPolicy extends Policy
{

    public function __construct()
    {
        parent::__construct();
    }

    public function view(User $user , Order $order=null)
    {
        return ($user->isAdmin() || $user->isCustomer());
    }
}
