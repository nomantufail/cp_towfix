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
                        </figure>
                        <div class="store-content">
                            <h4>{{$product->name}}</h4>
                            <h4>Price : {{$product->price}}$</h4>
                            <p>{{str_limit($product->detail, 60)}}</p>
                            <a href="{{url('/')}}/product/{{$product->id}}" class="btn btn-primary">View Product</a>
                            @if($product->is_poster)<a class="btn btn-primary productContactInfo" data-info="{{json_encode([
                                'address' => $product->address,
                                'contact' => $product->contact,
                                'email' => $product->email
                            ])}}" data-toggle="modal" data-target="#addContactInfoModal">Contact Info</a>@endif
                            @if(!$product->is_poster)<span data-id="{{$product->id}}" class="btn btn-primary @if(in_array($product->id,$productsInCart)) added_to_cart @else add_to_cart @endif">@if(in_array($product->id,$productsInCart)) Added To Cart @else Add To Cart @endif</span>@endif
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>


        <div id="addContactInfoModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Owner Information</h4>
                    </div>
                    <div class="modal-body">
                        <label>Contact: <span id="modal_product_contact">{{$product->contact}}</span></label><br>
                    </div>
                    <div class="modal-body">
                        <label>Email: <span id="modal_product_email">{{$product->email}}</span></label><br>
                    </div>
                    <div class="modal-body">
                        <label>Address: <span id="modal_product_address">{{$product->address}}</span></label><br><br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).on('click','.productContactInfo', function () {
            var modal = $("#addContactInfoModal");
            var contactInfo = JSON.parse($(this).attr('data-info'));
            modal.find('#modal_product_contact').text(contactInfo.contact);
            modal.find('#modal_product_address').text(contactInfo.address);
            modal.find('#modal_product_email').text(contactInfo.email);
        });
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