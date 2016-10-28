<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceRequestForm extends Model
{
    protected $table = 'cust_vehicle_srv_reqs_id';

    protected $fillable = ['customer_id', 'vehicle_id', 'franchise_id', 'work_type_id','suggested_date', 'suggested_by', 'message', 'status'];

    public function vehicle()
    {
        return $this->belongsTo('App\Models\Vehicle','vehicle_id');
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
    public function editing()
    {
        return $this->belongsTo('App\User','editing');
    }

    public function getStatus()
    {
        return $this->status == 0 ? 'pending' : 'accepted';
    }

    public function isPending()
    {
        return ($this->status == 0);
    }

    public function isAccepted()
    {
        return ($this->satatus == 1);
    }
}
