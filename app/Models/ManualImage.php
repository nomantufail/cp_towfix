<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ManualImage extends Model
{
    protected $table = 'manual_images';

    /**
     * Get the Product that owns the Image.
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Manual');
    }
}
