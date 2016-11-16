<?php
/**
 * Created by PhpStorm.
 * user: nomantufail
 * Date: 10/10/2016
 * Time: 10:13 AM
 */

namespace App\Repositories;

use App\User;

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
        return $this->getModel()->where('role', 2)->with('info')->get();
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