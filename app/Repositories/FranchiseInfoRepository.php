<?php
/**
 * Created by PhpStorm.
 * user: nomantufail
 * Date: 10/10/2016
 * Time: 10:13 AM
 */

namespace App\Repositories;


use App\Models\FranchiseInfo;

class FranchiseInfoRepository extends Repository
{
    public function __construct(FranchiseInfo $franchise_info)
    {
        $this->setModel($franchise_info);
    }


}