<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Repositories\UsersRepository;
use App\User;


class ApiController extends ParentController
{

    private $users = null;
    public function __construct()
    {
        parent::__construct();
        $this->users = new UsersRepository(new User());
    }

    public function displayFranchisesByArea(Requests\Request $request)
    {
            return $this->users->getFranchiseByArea($request->route()->parameter('franchise_area'));
    }

}
