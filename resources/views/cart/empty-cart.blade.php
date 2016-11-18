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
    <section class="empty-cart">
        <div class="container">
            <div class="empty-widget">
                <h2>Your Cart is Empty</h2>
                <a href="{{url('/')}}/products" type="submit" class="btn btn btn-primary"><i class="fa fa-shopping-bag"></i> Online Store</a></div>
            </div>
        </div>
    </section>
@endsection