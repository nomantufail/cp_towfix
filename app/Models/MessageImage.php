<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessageImage extends Model
{
    protected $table = 'message_images';

    /**
     * Get the Product that owns the Image.
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Message');
    }
}
