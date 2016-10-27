<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Repositories\UsersRepository;
use Illuminate\Support\Facades\Auth;
use Response;

class FranchisesController extends ParentController
{
    private $franchises = null;

    public function __construct(UsersRepository $franchises)
    {
        parent::__construct();
        $this->franchises = $franchises;
    }

    public function showFranchises(Requests\Franchise\ViewFranchisesRequest $request)
    {
        return view('franchise.list-franchises');
    }
    public function showAddFranchiseForm(Requests\Franchise\ShowAddFranchiseFormRequest $request)
    {
        return view('franchise.add-franchise');
    }
    public function storeFranchise(Requests\Franchise\AddFranchiseRequest $request)
    {

//        try{
            $this->franchises->store($request->storableAttrs());

            return redirect()->back()->with('success', 'Franchise Stored Successfully');
//        }catch (\Exception $e){
//            return $this->handleInternalServerError($e->getMessage());
//        }
    }

}
