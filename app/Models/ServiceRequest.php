<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    protected $table = 'cust_vehicle_srv_reqs';

    protected $fillable = ['vehicle_id', 'franchise_id', 'work_type_id','suggested_date', 'suggested_by'];
}
