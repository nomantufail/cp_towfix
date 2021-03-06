<?php
/**
 * Created by PhpStorm.
 * user: nomantufail
 * Date: 10/10/2016
 * Time: 10:13 AM
 */

namespace App\Repositories;

use App\Models\FranchiseInfo;
use App\User;
use Illuminate\Support\Facades\DB;

class UsersRepository extends Repository
{
    public function __construct(User $user)
    {
        $this->setModel($user);
    }

    public function getByIds($ids = [])
    {
        return  $this->getModel()->whereIn('id', $ids)->get();
    }

    public function franchises()
    {

        return $this->getModel()->where('role', 2)
            ->with('info')->get();
    }
    public function approvedFranchises()
    {
        $franchiseInfoTable = (new FranchiseInfoRepository(new FranchiseInfo()))->getModel()->getTable();
        $franchisesTable = $this->getModel()->getTable();
        return $this->getModel()->where($franchisesTable.".role",2)
            ->select('users.*',$franchiseInfoTable.".status")
            ->where($franchiseInfoTable.".status" , 1)
            ->leftJoin($franchiseInfoTable, $franchiseInfoTable.".user_id", "=", $franchisesTable.".id")
            ->get();
    }


    public function getFranchiseByArea($area)
    {
        $franchiseInfoTable = (new FranchiseInfoRepository(new FranchiseInfo()))->getModel()->getTable();
        $franchisesTable = $this->getModel()->getTable();
        return $this->getModel()->select($franchisesTable.".f_name", $franchisesTable.".l_name", $franchisesTable.".email", $franchisesTable.".phone_number", $franchisesTable.".address")
            ->leftJoin($franchiseInfoTable, $franchisesTable.".id", "=", $franchiseInfoTable.".user_id")
            ->where($franchiseInfoTable.".area",$area)
            ->where($franchiseInfoTable.".status" , 1)
            ->get();
    }
    public function customers()
    {
        return $this->getModel()->where('role', 3)->get();
    }
    public function admins()
    {
        return $this->getModel()->where('role', 1)->get();
    }

}