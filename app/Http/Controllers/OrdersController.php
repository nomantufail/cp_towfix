<?php

namespace App\Http\Controllers;

use App\Repositories\OrdersRepository;

use App\Http\Requests;

class OrdersController extends ParentController
{
    protected $orders = null;

    public function __construct(OrdersRepository $ordersRepository)
    {
        parent::__construct();
        $this->orders = $ordersRepository;
    }

    public function showOrders(Requests\Order\ShowOrdersRequest $request)
    {
        return view('orders.orders', [ 'orders' => $this->orders->getWithDetails() ]);
    }

    public function delete(Requests\Order\DeleteOrderRequest $request)
    {
        try{
            $this->orders->deleteById($request->route()->parameter('order_id'));
            return redirect()->back();
        }catch (\Exception $e){
            return $this->handleInternalServerError();
        }
    }
}
