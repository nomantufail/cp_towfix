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
        $orders = ($request->user()->isCustomer())?$this->orders->getByUserId($request->user()->id):$this->orders->getWithDetails();
        return view('orders.orders', [ 'orders' => $orders ]);
    }

    public function detail(Requests\Order\ShowOrderDetailRequest $request)
    {
        return view('orders.order-detail', [ 'order' => $this->orders->findById($request->route()->parameter('order_id')) ]);
    }

    public function shipped(Requests\Order\OrderShippedRequest $request)
    {
        $this->orders->updateWhere(['id'=>$request->route()->parameter('order_id')], ['is_done'=>1]);
        return redirect()->back()->with(['success'=>"order #".$request->route()->parameter('order_id')." has been shipped."]);
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
