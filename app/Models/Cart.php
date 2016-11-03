<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = "cart";

    protected $fillable = ['product_id', 'user_id'];
    /**
     * Get the images for the product.
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }


    /**
     * Get the orders that has this product.
     */
    public function customer()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
