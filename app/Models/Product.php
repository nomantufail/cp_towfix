<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";

    protected $fillable = ['name', 'price', 'detail'];
    /**
     * Get the images for the product.
     */
    public function images()
    {
        return $this->hasMany('App\Models\ProductImage');
    }
}
