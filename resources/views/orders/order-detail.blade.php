<?php
/**
 * Created by PhpStorm.
 * user: nomantufail
 * Date: 10/6/2016
 * Time: 3:25 PM
 */
?>
@extends('app') @section('page')
    <section class="vehicles-list">
        <div class="vehicles-head">
            <h2>Order Details (#{{$order->id}})</h2>
        </div>
        <div class="vehicles-list-content">
            <div class="vehicles-table">
                @if(\Session::has('success'))
                    <h4>{{\Session::get('success')}}</h4>
                @endif

                    <?php $total = 0;
                    foreach(json_decode($order->document) as $item)
                        $total +=  $item->product->price * $item->quantity;
                    ?>
                <div class="cart-summery">
                    <div class="summery-widget">
                        <div class="cart-list">
                            <ul class="cart-head">
                                <li class="product-name">Product Name</li>
                                <li class="product-price">Price</li>
                                <li class="product-quantity">Quantity</li>
                                <li class="computed_price">Total</li>
                            </ul>
                            @foreach(json_decode($order->document) as $item)
                                <ul class="cart-content">
                                    <li class="product-name">
                                        @if(sizeof($item->product->images))
                                            <figure><img src="{{url('/')}}/{{$item->product->images[0]->path}}" alt=""></figure>
                                        @endif
                                        <span>{{$item->product->name}}</span>
                                    </li>
                                    <li class="product-price">${{$item->product->price}}</li>
                                    <li class="product-quantity">
                                        {{$item->quantity}}
                                    </li>
                                    <li class="computed_price">{{$item->product->price * $item->quantity}}</li>
                                </ul>
                            @endforeach
                        </div>
                        <div class="cart-checkout">
                            <div class="cart-total">
                                <strong>Total:</strong>
                                <span>${{$total}}</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script type="text/javascript">


    </script>
@endsection