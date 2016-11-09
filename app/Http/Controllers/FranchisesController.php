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
        try{
            return view('franchise.list-franchises', ['franchises'=> $this->franchises->franchises()]);
        }catch (\Exception $e){
            return $this->handleInternalServerError($e->getMessage());
        }

    }
    public function showAddFranchiseForm(Requests\Franchise\ShowAddFranchiseFormRequest $request)
    {
        return view('franchise.add-franchise');
    }
    public function editFranchiseForm(Requests\Franchise\EditFranchiseRequest $request, $franchise_id)
    {

        try{
            $data = [
                'franchise' => $this->franchises->findById($franchise_id)
            ];
            return view('franchise.edit-franchise', $data);
        }catch (\Exception $e){
            return $this->handleInternalServerError($e->getMessage());
        }
    }
    public function updateFranchise(Requests\Franchise\UpdateFranchiseRequest $request, $franchise_id)
    {

        try{
            $this->franchises->updateWhere(['id' => $franchise_id], $request->updateableAttrs());
            return redirect()->back()->with('success','Franchise updated Successfully');
        }catch (\Exception $e){
            return $this->handleInternalServerError($e->getMessage());
        }
    }

    public function storeFranchise(Requests\Franchise\AddFranchiseRequest $request)
    {

        try{
            $this->franchises->store($request->storableAttrs());

            return redirect()->back()->with('success', 'Franchise Stored Successfully');
        }catch (\Exception $e){
            return $this->handleInternalServerError($e->getMessage());
        }
    }
    public function delete(Requests\Franchise\DeleteFranchiseRequest $request , $franchise_id)
    {
        try{
            $this->franchises->deleteById($franchise_id);
            return redirect()->back()->with('success','Franchise deleted successfully');
        }catch (\Exception $e){
            return $this->handleInternalServerError($e->getMessage());
        }
    }

}
