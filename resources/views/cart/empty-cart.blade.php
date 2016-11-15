<?php
/**
 * Created by PhpStorm.
 * user: nomantufail
 * Date: 10/6/2016
 * Time: 3:25 PM
 */
?>
@extends('app')
@section('page')
    <section class="success-payment">
        <h2 style="color:green">
            <span style="font-size: 50px;">Your Cart is Empty</span>
            <a href="{{url('/')}}/products" type="submit" class="btn btn btn-primary">Online Store</a>
        </h2>
    </section>
@endsection