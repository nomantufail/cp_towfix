<?php

namespace App;

use App\Traits\Authorization\ShouldBeAuthorized;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Mail;
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
    public function info()
    {
        return $this->hasOne('App\Models\FranchiseInfo','user_id');
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

    public function mail($view, $data=null)
    {
        $user = clone($this);
        Mail::send($view, ['data' => $data], function ($m) use ($user) {
            $m->from(env('MAIL_FROM_ADDRESS'), env('APPLICATION_DISPLAY_NAME'));
            $m->to($user->email, $user->f_name." ".$user->l_name)->subject('Next Service Reminder');
        });
    }
}
