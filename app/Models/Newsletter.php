<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    protected $table = "newsletters";
    protected $fillable = ['name', 'detail'];

    /**
     * Get the images for the product.
     */
    public function images()
    {
        return $this->hasMany('App\Models\NewsletterImage');
    }
}
