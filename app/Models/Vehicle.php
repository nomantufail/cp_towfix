<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $table = 'vehicles';

    protected $fillable = ['vehicle_type_id', 'customer_id', 'make', 'model', 'year', 'year_purchased', 'last_service', 'next_service', 'registration_number', 'registration_expiry', 'engine_capacity', 'number_axles', 'details'];

    public function owner()
    {
        return $this->belongsTo('App\User','customer_id');
    }

    public function serviceRequests()
    {
        return $this->hasMany('App\Models\ServiceRequest');
    }
}
