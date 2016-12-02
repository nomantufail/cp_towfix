<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Repositories\FranchiseInfoRepository;
use App\Repositories\UsersRepository;
use Illuminate\Support\Facades\Auth;
use Response;

class FranchisesController extends ParentController
{
    private $franchises = null;
    private  $franchiseInfo = null;

    public function __construct(UsersRepository $franchises , FranchiseInfoRepository $franchise_info)
    {
        parent::__construct();
        $this->franchises = $franchises;
        $this->franchiseInfo = $franchise_info;
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
        if(Auth::user() != null)
            return redirect()->route('home');
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
            $this->franchiseInfo->updateWhere(['user_id' => $franchise_id],
            [
                'address' =>$request->input('address'),
                'area'    => $request->input('area')
            ]);
            return redirect()->back()->with('success','Franchise updated Successfully');
        }catch (\Exception $e){
            return $this->handleInternalServerError($e->getMessage());
        }
    }

    public function storeFranchise(Requests\Franchise\AddFranchiseRequest $request)
    {

        if(Auth::user() != null)
            return redirect()->route('home');
        try{
            $franchise = $this->franchises->store($request->storableAttrs());
            $this->franchiseInfo->store([
                'user_id' => $franchise->id,
                'address' => $franchise->address,
                'area'    => $request->input('area')
            ]);
            $franchise->mail('mail.franchise-register-request','TowFix Franchise Request', $franchise->f_name);
            return redirect()->back()->with('success', 'Your request has been sent to admin for approval');
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

    public function approve(Requests\Franchise\FranchiseApproveRequest $request , $franchise_id)
    {
        try{
            $this->franchiseInfo->updateWhere(['user_id' => $franchise_id], ['status'=>1]);
            $franchise = $this->franchises->findById($franchise_id);
            $franchise->mail('mail.franchise-register-accept','TowFix Franchise Acceptance',$franchise->f_name);
           return redirect()->back()->with('success','Franchise Approved successfully');
        }catch (\Exception $e){
            return $this->handleInternalServerError($e->getMessage());
        }
    }



}
