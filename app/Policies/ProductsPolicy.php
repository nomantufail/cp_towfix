<?php

namespace App\Policies;

use App\User;
use App\Models\Product;

class ProductsPolicy extends Policy
{

    public function __construct()
    {
        parent::__construct();
    }

    public function view(User $user , Product $product=null)
    {
        return ($user->isAdmin());
    }
}
