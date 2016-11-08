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
    <style>
        .adding_to_cart{
            background-color: orange;
        }
        .added_to_cart{
            background-color: green;
        }
    </style>
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
                            @if(!$product->is_poster)<span data-id="{{$product->id}}" class="btn btn-primary @if(in_array($product->id,$productsInCart)) added_to_cart @else add_to_cart @endif">@if(in_array($product->id,$productsInCart)) Added To Cart @else Add To Cart @endif</span>@endif
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </section>
    <script>
        $(document).on("click",'.add_to_cart', function () {
            var product_id = $(this).attr('data-id');
            var btn = $(this);
            btn.removeClass('add_to_cart');
            btn.addClass('adding_to_cart');
            btn.html('adding to cart...');
            $.ajax({type: 'POST' , data: {'_token':"<?=csrf_token()?>" }, url: base_url + 'cart/add/'+product_id ,
                success: function (data){
                    btn.removeClass('adding_to_cart');
                    btn.addClass('added_to_cart');
                    btn.html('Added To Cart');
                }
            });
        })
    </script>
@endsection