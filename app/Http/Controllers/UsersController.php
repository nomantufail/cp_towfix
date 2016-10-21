<?php

namespace App\Http\Controllers;


use App\Http\Requests;
use App\Repositories\UsersRepository;

class UsersController extends ParentController
{
    protected $users = null;

    public function __construct(UsersRepository $usersRepository)
    {
        parent::__construct();
        $this->users = $usersRepository;
    }

    public function listCustomers(Requests\Users\ListCustomersRequest $request)
    {
        return view('user.customers', [ 'customers' => $this->users->customers() ]);
    }

    public function delete(Requests\Users\DeleteUserRequest $request)
    {
        try{
            $this->users->deleteById($request->route()->parameter('user_id'));
            return redirect()->back();
        }catch (\Exception $e){
            return $this->handleInternalServerError();
        }
    }
}
