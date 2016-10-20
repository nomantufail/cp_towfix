<?php

namespace App;

use App\Traits\Authorization\ShouldBeAuthorized;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, ShouldBeAuthorized;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'f_name', 'l_name', 'email', 'password', 'address', 'phone_number'
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
