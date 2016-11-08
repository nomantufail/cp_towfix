<?php
/**
 * Created by PhpStorm.
 * user: nomantufail
 * Date: 10/10/2016
 * Time: 10:13 AM
 */

namespace App\Repositories;

use App\Libs\Helpers\Helper;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class CartRepository extends Repository
{
    public function __construct(Cart $cart)
    {
        $this->setModel($cart);
    }

    public function userCart($userId)
    {
        return $this->getModel()->with(['product' => function ($query) {
            $query->with('images');
        }])->where('user_id',$userId)->get();
    }

    public function userProductIds($userId)
    {
        return Helper::propertyToArray($this->getModel()->where('user_id',$userId)->get()->all(), 'product_id');
    }

    public function addProduct($userId, $productId)
    {
        $alreadyAdded = $this->getModel()->where('user_id',$userId)->where('product_id',$productId)->count();
        if($alreadyAdded){
            return $this->getModel()->where('user_id',$userId)->where('product_id',$productId)->first()->increment('quantity');
        }else{
            return $this->getModel()->create([
                'product_id' => $productId,
                'user_id' => $userId
            ]);
        }
    }

    public function removeProduct($userId, $productId)
    {
        return $this->getModel()->where([
            'user_id'=>$userId,
            'product_id' => $productId
        ])->delete();
    }

    public function totalPrice($userId)
    {
        $productsTable = (new ProductsRepository(new Product()))->getModel()->getTable();
        $cartTable = $this->getModel()->getTable();
        $result = DB::table('cart')
              ->select(DB::raw('sum('.$cartTable.'.quantity * '.$productsTable.'.price) as total_price'))
              ->where('cart.user_id', '=', $userId)
              ->leftJoin($productsTable, 'products.id', '=', $cartTable.'.product_id')
              ->groupBy($cartTable.'.user_id')
              ->first();
        return ($result != null)?intval($result->total_price):0;
    }


}