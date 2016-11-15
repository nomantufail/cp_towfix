<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Cart;
use App\Models\Product;
use App\Repositories\CartRepository;
use App\Repositories\OrdersRepository;
use App\Repositories\ProductImagesRepository;
use App\Repositories\ProductsRepository;
use App\Repositories\UsersRepository;
use App\Repositories\VehiclesRepository;
use App\User;
use Illuminate\Support\Facades\Auth;
use Response;
use Stripe\Stripe;

class CartController extends ParentController
{
    private $products = null;
    private $productImages = null;
    private $cart = null;
    private $orders = null;
    public function __construct(ProductsRepository $productsRepo,
                                ProductImagesRepository $productImagesRepo, CartRepository $cartRepository, OrdersRepository $ordersRepository)
    {
        parent::__construct();
        $this->products = $productsRepo;
        $this->productImages = $productImagesRepo;
        $this->cart = $cartRepository;
        $this->orders = $ordersRepository;
    }

    public function myCart(Requests\Cart\ListMyCartRequest $request)
    {
        $items = $this->cart->userCart($request->user()->id);
        if (sizeof($items) == 0)
        {
            return view('cart.empty-cart');
        }
        return view('cart.list',[
            'items'=>$this->cart->userCart($request->user()->id),
            'total_price' => $this->cart->totalPrice($request->user()->id)
        ]);
    }

    public function confirmCart(Requests\Cart\ConfirmCartRequest $request)
    {
        if(sizeof($request->input('item')) == 0)
            return redirect()->back();
        foreach($request->input('item') as $item){
            $this->cart->updateWhere(['product_id'=>$item['product_id'], 'user_id'=>Auth::user()->id], [
                'quantity' => $item['quantity']
            ]);
        }
        return view('cart.cart-summery',[
            'items'=>$this->cart->userCart($request->user()->id),
            'total_price' => $this->cart->totalPrice($request->user()->id)
        ]);
    }

    public function checkout(Requests\Cart\CheckoutRequest $request)
    {
        try{
            $amount = $this->cart->totalPrice($request->user()->id);
            if($amount <= 0){
                return redirect()->back()->with(['error'=>'Amount should be greater then 0']);
            }

            Auth::user()->charge($amount*100, ['source' => $request->input('stripeToken')]);
            $this->orders->store([
                'user_id' => Auth::user()->id,
                'document' =>  $this->cart->userCart(Auth::user()->id)->toJson(),
                'total_price' => $this->cart->totalPrice(Auth::user()->id)
            ]);
            $this->cart->flush(Auth::user()->id);

            return view('cart.success',['data'=>[
                'amount' => $amount
            ]]);
        }catch (\Exception $e){
            return redirect()->route('mycart');
        }
    }

    public function addProduct(Requests\Cart\AddToCartRequest $request)
    {
        return $this->cart->addProduct($request->user()->id, $request->route()->parameter('product_id'));
    }

    public function removeItem($product_id)
    {
        return $this->cart->removeProduct(request()->user()->id, $product_id);

    }

}
