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
    <section class="vehicles-list">
        <div class="vehicles-head">
            <h2>Order Details (#{{$order->id}})</h2>

        </div>
        <div class="vehicles-list-content">
            <div class="vehicles-table">

                <table id="tableStyle" class="display" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>quantity</th>
                        <th>Price</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach(json_decode($order->document) as $item)
                        <tr>
                            <td>{{$item->product->name}}</td>
                            <td>{{$item->quantity}}</td>
                            <td class="computed_price">{{$item->product->price * $item->quantity}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr style="font-weight: bold">
                        <td colspan="2">Total Price</td>
                        <td id="computed_total_price">{{$order->total_price}}</td>
                    </tr>
                    </tfoot>
                </table>
                @if($user->isAdmin() && $order->is_done == 0)
                    <form action="{{url('/')}}/order/shipped/{{$order->id}}" method="post">
                        {{csrf_field()}}
                        <input type="submit" value="Order Shipped">
                    </form>
                @endif
            </div>
        </div>
    </section>
@endsection