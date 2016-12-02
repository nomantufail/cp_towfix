<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'fName' => 'required|max:255',
            'lName' => 'required|max:255',
            'address' => 'required|max:200',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'g-recaptcha-response'=>'required|google_recapcha',
        ]);
    }
    public function messages()
    {
        return [
            'g-recaptcha-response.google_recapcha' => 'you are a robot',
            'g-recaptcha-response.required' => 'Capcha field is required'
        ];
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user =  User::create([
            'f_name' => $data['fName'],
            'l_name' => $data['lName'],
            'phone_number' => $data['phoneNumber'],
            'address' => $data['address'],
            'lName' => $data['lName'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
        $user->mail('mail.customer-register','Welcome Valued customer',$user->f_name);
        return $user;
    }
}
