<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkType extends Model {

    protected $table = "work_types";
    protected $fillable = ['work_type'];
    /**
     * Get the Product of the Order.
     */
    public function services()
    {
        return $this->hasMany('App\Models\ServiceRequest');
    }
}
