<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Cart;
use App\Models\Product;
use App\Repositories\CartRepository;
use App\Repositories\ProductImagesRepository;
use App\Repositories\ProductsRepository;
use App\Repositories\UsersRepository;
use App\Repositories\VehiclesRepository;
use App\User;
use Illuminate\Support\Facades\Auth;
use Response;

class CartController extends ParentController
{
    private $products = null;
    private $productImages = null;
    private $cart = null;
    public function __construct(ProductsRepository $productsRepo,
                                ProductImagesRepository $productImagesRepo, CartRepository $cartRepository)
    {
        parent::__construct();
        $this->products = $productsRepo;
        $this->productImages = $productImagesRepo;
        $this->cart = $cartRepository;
    }

    public function myCart(Requests\Cart\ListMyCartRequest $request)
    {
        return view('cart.list',[
            'items'=>$this->cart->userCart($request->user()->id),
            'total_price' => $this->cart->totalPrice($request->user()->id)
        ]);
    }

    public function confirmCart(Requests\Cart\ConfirmCartRequest $request)
    {
        dd($request->all());
    }

    public function removeItem($product_id)
    {
        return $this->cart->removeProduct(request()->user()->id, $product_id);
    }

}
