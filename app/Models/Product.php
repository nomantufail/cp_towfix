<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";

    protected $fillable = ['name', 'price', 'detail', 'contact', 'email', 'address','is_poster'];
    /**
     * Get the images for the product.
     */
    public function images()
    {
        return $this->hasMany('App\Models\ProductImage');
    }

    /**
     * Get Cart of the product
     */
    public function cart()
    {
        return $this->hasMany('App\Models\Cart','product_id');
    }

    /**
     * Get the orders that has this product.
     */
    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }
}
