<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceRequestForm extends Model
{
    protected $table = 'vehicle_srv_req_forms';

    protected $fillable = ['cust_vehicle_srv_reqs_id', 'document'];

    public function serviceRequest()
    {
        return $this->belongsTo('App\Models\ServiceRequest','cust_vehicle_srv_reqs_id');
    }
}
