<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manual extends Model
{
    protected $table = "manuals";

    protected $fillable = ['title' , 'description'];
    /**
     * Get the images for the product.
     */
    public function images()
    {
        return $this->hasMany('App\Models\ManualImage');
    }


}
