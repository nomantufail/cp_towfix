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

    public function showCustomerDetails(Requests\Users\ShowCustomerDetailsRequest $request)
    {
        return view('user.customer-details', [ 'customer' => $this->users->findById($request->route()->parameter('customer_id')) ]);
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
    public function editCustomer(Requests\Users\EditUserRequest $request)
    {
        try{
            $data = [
                'customer' => $this->usersRepo->findById($request->route()->parameter('user_id')),
            ];
            return view('user.edit-customer-form', $data);
        }catch (\Exception $e){
            return $this->handleInternalServerError($e->getMessage());
        }
    }
    public function updateCustomer(Requests\Users\UpdateCustomerRequest $request)
    {
        try{
            $this->usersRepo->updateWhere(['id'=>$request->route()->parameter('customer_id')], $request->updateableAttrs());
            return redirect()->back()->with(['success'=> 'Profile updated successfully']);
        }catch (\Exception $e){
            return $this->handleInternalServerError($e->getMessage());
        }
    }
}
