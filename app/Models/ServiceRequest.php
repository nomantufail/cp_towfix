<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    protected $table = 'cust_vehicle_srv_reqs';

    protected $fillable = ['customer_id', 'vehicle_id', 'franchise_id', 'work_type_id','suggested_date', 'suggested_by', 'message'];

    public function vehicle()
    {
        return $this->belongsTo('App\Models\Vehicle');
    }

    public function franchise()
    {
        return $this->belongsTo('App\User','franchise_id');
    }
    public function customer()
    {
        return $this->belongsTo('App\User','customer_id');
    }

    public function workType()
    {
        return $this->belongsTo('App\Models\WorkType','work_type_id');
    }
    public function suggestedUser()
    {
        return $this->belongsTo('App\User','suggested_by');
    }

    public function getStatus()
    {
        return $this->status == 0 ? 'pending' : 'active';
    }
}
