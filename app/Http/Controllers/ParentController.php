<?php

namespace App\Http\Controllers;

use App\Repositories\UsersRepository;
use App\Traits\ExceptionHandler;

use App\Http\Requests;
use App\User;

class ParentController extends Controller
{
    use ExceptionHandler;

    protected $usersRepo = null;
    public function __construct()
    {
        $this->usersRepo = new UsersRepository(new User());
    }
}
