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
    <section class="vehicles-list cart-page">
        <div class="vehicles-head">
            <h2><i class="fa fa-cart-arrow-down"></i> My Shopping Cart</h2>
        </div>
        <div class="vehicles-list-content">
            <div class="vehicles-table">
                @if(\Session::has('success'))
                    <h4>
                        {{\Session::get('success')}}
                    </h4>
                @endif

				<form action="{{url('/cart/confirm')}}" method="post" onsubmit="return true">
						{{csrf_field()}}
					<div class="cart-list">
						<ul class="cart-head">
							<li class="product-name">Product</li>
							<li class="product-price">Price</li>
							<li class="product-quantity">Quantity</li>
							<li class="computed_price">Total</li>
							<li class="remove-product">Action</li>
						</ul>
						@foreach($items as $item)
							<ul class="cart-content">
								<input type="hidden" name="item[{{$item->id}}][id]" value="{{$item->id}}" class="item_id">
								<input type="hidden" name="item[{{$item->id}}][product_id]" value="{{$item->product->id}}" class="product_id">
								<input type="hidden" name="item[{{$item->id}}][price]" value="{{$item->product->price}}" class="product_price">

								<li class="product-name">
									@if(sizeof($item->product->images))
										<figure><img src="{{url('/')}}/{{$item->product->images[0]->path}}" alt=""></figure>
									@endif
									<span>{{$item->product->name}}</span>
								</li>
								<li class="product-price">${{$item->product->price}}</li>
								<li class="product-quantity">
									<input type="number" min="1" name="item[{{$item->id}}][quantity]" value="{{$item->quantity}}" class="item_quantity">
								</li>
								<li class="computed_price"></li>
								<li class="remove-product">
									<a href="#"><i class="fa fa-close remove_item"></i></a>
								</li>
							</ul>
						@endforeach

					</div>
					<div class="cart-checkout">
						<div class="cart-total">
							<strong>Total:</strong>
							<span id="computed_total_price"></span>
						</div>
						<input class="cart-btn" type="submit" value="Save & Continue">
					</div>
               </form>
            </div>
        </div>
    </section>
    <script>
        function quantityChanged(){
            var total_price = 0;
            $('.item_quantity').each(function () {
                var quantity = $(this).val();
                var price = $(this).closest('ul').find('.product_price').val();
                var computed_price = parseFloat(quantity) * parseFloat(price);
                $(this).closest('ul').find('.computed_price').html(computed_price);
                total_price+=computed_price;
            });
            $("#computed_total_price").html(total_price);
        }
        $(document).on('change keyup', '.item_quantity', function () {
            quantityChanged();
        });

        $(document).on('click','.remove_item', function () {
            var ul = $(this).closest('ul');
            var product_id = $(this).closest('ul').find('.product_id').val();
            $.ajax({type: 'POST' , data: {'_token':"<?=csrf_token()?>" }, url: base_url + 'cart/remove/'+product_id ,
                success: function (data){
                    ul.remove();
                    quantityChanged();
                },
                error: function () {
                    alert('something went wrong with the server!');
                }
            });
        });

        $(document).ready(function () {
            quantityChanged();
        });
    </script>
@endsection