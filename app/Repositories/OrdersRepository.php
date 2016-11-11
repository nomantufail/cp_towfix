<?php
/**
 * Created by PhpStorm.
 * user: nomantufail
 * Date: 10/10/2016
 * Time: 10:13 AM
 */

namespace App\Repositories;

use App\Models\Order;

class OrdersRepository extends Repository
{
    public function __construct(Order $order)
    {
        $this->setModel($order);
    }

    public function getWithDetails()
    {
        return $this->getModel()->with('user')->get();
    }
    public function getByUserId($id)
    {
        return $this->getModel()->with('user')->where('user_id',$id)->get();
    }
}