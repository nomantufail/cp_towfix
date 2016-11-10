<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {

    protected $table = "orders";
    protected $fillable = ['user_id','document'];
    /**
     * Get the Product of the Order.
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
