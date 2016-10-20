<?php
/**
 * Created by PhpStorm.
 * User: nomantufail
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
        return $this->getModel()->with('user')->with('product')->get();
    }
}