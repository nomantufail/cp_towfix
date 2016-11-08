<?php

namespace App\Policies;

use App\Models\Cart;
use App\User;
use App\Models\Product;

class CartPolicy extends Policy
{

    public function __construct()
    {
        parent::__construct();
    }

    public function view(User $user , Cart $cart=null)
    {
        return $user->isCustomer();
    }
}
