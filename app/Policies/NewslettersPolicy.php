<?php

namespace App\Policies;

use App\Models\Newsletter;
use App\User;

class NewsletterPolicy extends Policy
{

    public function __construct()
    {
        parent::__construct();
    }

    public function view(User $user , Newsletter $newsletter=null)
    {
        return ($user->isAdmin() || $user->isCustomer());
    }
}
