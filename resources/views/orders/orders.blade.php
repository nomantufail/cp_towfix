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
                    @if($user->isAdmin())<th>Customer Name</th>@endif
                    @if($user->isAdmin())<th>Customer Number</th>@endif
                    <th>Total Price</th>
                    <th>Order Date/Time</th>
                    @if($user->isAdmin())<th>Status</th>@endif
                    <th>Detail</th>
                    <th colspan="">Actions</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>

                @foreach($orders as $order)
                <tr>
                    <td>{{$order->id}}</td>
                    @if($user->isAdmin())<td>{{$order->user->f_name}} {{$order->user->l_name}}</td>@endif
                    @if($user->isAdmin())<td>{{$order->user->phone_number}}</td>@endif
                    <td>${{$order->total_price}}</td>
                    <td>{!! \App\Libs\Helpers\Helper::towfixDateFormat($order->created_at) !!} <span style="font-size: 12px;">{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$order->created_at)->toTimeString()}}</span></td>
                    @if($user->isAdmin())
                        <td>
                            @if($order->is_done)
                                <span style="color:green">Shipped</span>
                            @else
                                <form action="{{url('/')}}/order/shipped/{{$order->id}}" method="post">
                                    {{csrf_field()}}
                                    <input type="submit" value="Ship Order">
                                </form>
                            @endif
                        </td>
                    @endif
                    <td><a href="{{url('/')}}/order/detail/{{$order->id}}">View</a></td>
                    <td>
                        <form method="post" action="{{url('/')}}/order/delete/{{$order->id}}">{{csrf_field()}}<button><i class="fa fa-trash fa-fw"></i></button></form>
                    </td>
                    <td></td>
                    <td></td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>

@endsection
