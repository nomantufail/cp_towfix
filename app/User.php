<?php

namespace App;

use App\Traits\Authorization\ShouldBeAuthorized;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use Notifiable, ShouldBeAuthorized, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'f_name', 'l_name', 'email', 'password', 'address', 'phone_number', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function vehicles()
    {
        return $this->hasMany('App\Models\Vehicle','customer_id');
    }

    public function cart()
    {
        return $this->hasMany('App\Models\Cart');
    }

    public function isAdmin(){
        return ($this->role == 1);
    }
    public function isFranchise(){
        return ($this->role == 2);
    }
    public function isCustomer(){
        return ($this->role == 3);
    }
}
