<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsletterImage extends Model
{
    protected $table = 'newsletter_images';

    /**
     * Get the Product that owns the Image.
     */
    public function newsletter()
    {
        return $this->belongsTo('App\Models\Newsletter');
    }
}
