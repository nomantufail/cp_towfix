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
				
               	<div class="cart-list">
					<ul class="cart-head">
						<li class="product-name">Product</li>
						<li class="product-price">Price</li>
						<li class="product-quantity">Quantity</li>
						<li class="computed_price">Total</li>
						<li class="remove-product">Action</li>
					</ul>
					<ul class="cart-content">
						<li class="product-name">
							<figure><img src="{{url('/')}}/images/profile.jpg" alt=""></figure>
							<span>Product Name Here</span>
						</li>
						<li class="product-price">$500</li>
						<li class="product-quantity">
							<input type="text" name="quantity" placeholder="quantity">
						</li>
						<li class="computed_price">100</li>
						<li class="remove-product">
							<a href="#"><i class="fa fa-close"></i></a>
						</li>
					</ul>
					<ul class="cart-content">
						<li class="product-name">
							<figure><img src="{{url('/')}}/images/profile.jpg" alt=""></figure>
							<span>Product Name Here</span>
						</li>
						<li class="product-price">$500</li>
						<li class="product-quantity">
							<input type="text" name="quantity" placeholder="quantity">
						</li>
						<li class="computed_price">100</li>
						<li class="remove-product">
							<a href="#"><i class="fa fa-close"></i></a>
						</li>
					</ul>
					<ul class="cart-content">
						<li class="product-name">
							<figure><img src="{{url('/')}}/images/profile.jpg" alt=""></figure>
							<span>Product Name Here</span>
						</li>
						<li class="product-price">$500</li>
						<li class="product-quantity">
							<input type="text" name="quantity" placeholder="quantity">
						</li>
						<li class="computed_price">100</li>
						<li class="remove-product">
							<a href="#"><i class="fa fa-close"></i></a>
						</li>
					</ul>
					<ul class="cart-content">
						<li class="product-name">
							<figure><img src="{{url('/')}}/images/profile.jpg" alt=""></figure>
							<span>Product Name Here</span>
						</li>
						<li class="product-price">$500</li>
						<li class="product-quantity">
							<input type="text" name="quantity" placeholder="quantity">
						</li>
						<li class="computed_price">100</li>
						<li class="remove-product">
							<a href="#"><i class="fa fa-close"></i></a>
						</li>
					</ul>
					<ul class="cart-content">
						<li class="product-name">
							<figure><img src="{{url('/')}}/images/profile.jpg" alt=""></figure>
							<span>Product Name Here</span>
						</li>
						<li class="product-price">$500</li>
						<li class="product-quantity">
							<input type="text" name="quantity" placeholder="quantity">
						</li>
						<li class="computed_price">100</li>
						<li class="remove-product">
							<a href="#"><i class="fa fa-close"></i></a>
						</li>
					</ul>
				</div>
				<div class="cart-checkout">
					<div class="cart-total">
						<strong>Total:</strong>
						<span>$855</span>
					</div>
					<input class="cart-btn" type="submit" value="Save & Continue">
				</div>
               
               
                <form action="{{url('/cart/confirm')}}" method="post" onsubmit="return true">
                    {{csrf_field()}}
                    
                    <table id="tableStyle" class="display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Price/Product</th>
                                <th>quantity</th>
                                <th>Computed Price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)
                        <tr>
                            <input type="hidden" name="item[{{$item->id}}][id]" value="{{$item->id}}" class="item_id">
                            <input type="hidden" name="item[{{$item->id}}][product_id]" value="{{$item->product->id}}" class="product_id">
                            <input type="hidden" name="item[{{$item->id}}][price]" value="{{$item->product->price}}" class="product_price">
                            <td>{{$item->product->name}}</td>
                            <td>{{$item->product->price}}</td>
                            <td><input type="number" name="item[{{$item->id}}][quantity]" value="{{$item->quantity}}" class="item_quantity"></td>
                            <td class="computed_price"></td>
                            <td>
                                <a class="remove_item">delete</a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr style="font-weight: bold">
                            <td colspan="3">Total Price</td>
                            <td id="computed_total_price"></td>
                            <td></td>
                        </tr>
                        </tfoot>
                    </table>
                    <input type="submit" value="Save & Continue -->">
                </form>
            </div>
        </div>
    </section>
    <script>
        function quantityChanged(){
            var total_price = 0;
            $('.item_quantity').each(function () {
                var quantity = $(this).val();
                var price = $(this).closest('tr').find('.product_price').val();
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
            var tr = $(this).closest('tr');
            var product_id = $(this).closest('tr').find('.product_id').val();
            $.ajax({type: 'POST' , data: {'_token':"<?=csrf_token()?>" }, url: base_url + 'cart/remove/'+product_id ,
                success: function (data){
                    tr.remove();
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