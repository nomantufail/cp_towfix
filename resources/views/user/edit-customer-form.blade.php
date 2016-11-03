<?php
/**
 * Created by PhpStorm.
 * user: nomantufail
 * Date: 10/20/2016
 * Time: 10:07 AM
 */

?>

@extends('app')
@section('page')
    <section class="home-page login-page">
        @if(\Session::has('success'))
            <h4>
                {{\Session::get('success')}}
            </h4>
        @endif
        <div class="add-vehicle-widget">
            <form class="add-vehicle-form" role="form" method="POST" action="{{ url('/customer/update/')}}/{{$customer->id}}">
                {{ csrf_field() }}

                <label class="half-field {{ $errors->has('fName') ? ' has-error' : '' }}">
                    <span>First Name</span>
                    <input type="text" name="fName" placeholder="First Name" value="{{$customer->f_name}}">
                    @if ($errors->has('fName'))
                        <span class="help-block">
                            <strong>{{ $errors->first('fName') }}</strong>
                        </span>
                    @endif
                </label>
                <label class="half-field {{ $errors->has('lName') ? ' has-error' : '' }}">
                    <span>Last Name</span>
                    <input type="text" name="lName" placeholder="Last Name" value="{{$customer->l_name}}">
                    @if ($errors->has('lName'))
                        <span class="help-block">
                            <strong>{{ $errors->first('lName') }}</strong>
                        </span>
                    @endif
                </label>
                <label class="half-field {{ $errors->has('phoneNumber') ? ' has-error' : '' }}">
                    <span>Phone Number</span>
                    <input type="text" name="phoneNumber" placeholder="Phone Number" value="{{$customer->phone_number}}">
                    @if ($errors->has('fName'))
                        <span class="help-block">
                            <strong>{{ $errors->first('phoneNumber') }}</strong>
                        </span>
                    @endif
                </label>
                <label class="half-field {{ $errors->has('email') ? ' has-error' : '' }}">
                    <span>Email Address</span>
                    <input type="email" name="email" placeholder="Email Address" value="{{$customer->email}}">
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </label>
                <label class="half-field {{ $errors->has('password') ? ' has-error' : '' }}">
                    <span>Password</span>
                    <input type="password" name="password" placeholder="Password">
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </label>
                <label class="half-field {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <span>Confirm Password</span>
                    <input type="password" name="password_confirmation" placeholder="Cunform Password">
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </label>
                <label class=" {{ $errors->has('address') ? ' has-error' : '' }}">
                    <span>Address</span>
                    <input type="text" name="address" placeholder="Address" value="{{$customer->address}}">
                    @if ($errors->has('address'))
                        <span class="help-block">
                            <strong>{{ $errors->first('address') }}</strong>
                        </span>
                    @endif
                </label>
                <label class="submit">
                    <input type="submit" class="btn btn btn-primary" name="submit" value="Submit">
                </label>
            </form>
        </div>
    </section>
@endsection
