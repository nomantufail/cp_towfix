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

<section class="vehicles-list">
    <div class="vehicles-head">
        <h3>Order</h3>
    </div>
    <div class="vehicles-list-content">
        <div class="vehicles-table">
            <table id="tableStyle" class="display" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Customer Number</th>
                    <th>Product name</th>
                    <th>Product Price</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>

                @foreach($orders as $order)
                <tr>
                    <td>{{$order->id}}</td>
                    <td>{{$order->user->f_name}} {{$order->user->l_name}}</td>
                    <td>{{$order->user->phone_number}}</td>
                    <td>{{$order->product->name}}</td>
                    <td>${{$order->product->price}}</td>
                    <td>
                        <form method="post" action="{{url('/')}}/order/delete/{{$order->id}}">{{csrf_field()}}<button><i class="fa fa-trash fa-fw"></i></button></form>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>

@endsection
