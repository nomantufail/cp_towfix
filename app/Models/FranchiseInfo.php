<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FranchiseInfo extends Model
{
    protected $table = "franchises_info";

    protected $fillable = ['user_id' ,'address', 'status'];
    /**
     * Get the images for the product.
     */
    public function franchiseProfile()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }
}
