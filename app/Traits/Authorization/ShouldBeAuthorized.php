<?php
/**
 * Created by PhpStorm.
 * User: nomantufail
 * Date: 10/7/2016
 * Time: 10:48 AM
 */

namespace App\Traits\Authorization;
trait ShouldBeAuthorized
{
    public function can($action, $policy, $model=null){
        $PolicyClass = ucfirst($policy)."Policy";
        $policy = new $PolicyClass();
        if($policy->$action($this, $model))
            return true;
        else
            return false;
    }
    public function cannot($action, $policy, $model = null){
        return !$this->can($action, $policy, $model);
    }
}