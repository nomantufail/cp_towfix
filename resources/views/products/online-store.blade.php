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
    <section class="store-panel">
        <h2 class="main-heading">Online Store</h2>
        <div class="store-listing">
            <ul class="row">
                @foreach($products as $product)
                <li class="col-md-3 col-sm-3 col-xm-12">
                    <div class="store-widget">
                        <figure>
                            @if(count($product->images))
                                <img src="{{url('/')}}/{{$product->images[0]->path}}" alt="">
                            @endif
                            <h4>{{$product->title}}</h4>
                        </figure>
                        <div class="store-content">
                            <p>{{str_limit($product->detail, 150)}}</p>
                            <a href="{{url('/')}}/product/{{$product->id}}" class="btn btn-primary">View Product</a>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </section>
@endsection