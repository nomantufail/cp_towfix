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
			<h2>Shopping Summery</h2>
		</div>
		<div class="vehicles-list-content">
			<div class="vehicles-table">
				@if(\Session::has('success'))
				<h4>{{\Session::get('success')}}</h4> 
				@endif
				
				<div class="cart-summery">
					<div class="summery-widget">
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
						</div>
					</div>
					<div class="payment-widget">
						<h4>Credit Card Information</h4>
						<form>
							<label>
								<span>Card Number</span>
								<input type="text" name="" placeholder="Enter Your Card Number">
							</label>
							<label class="half-field">
								<span>Expiration (MM/YY)</span>
								<input type="text" name="" placeholder="Month"> / 
								<input type="text" name="" placeholder="Year">
							</label>
							<label>
								<span>CVC Code</span>
								<input type="text" name="" placeholder="Enter CVC Code">
							</label>
							<input class="cart-btn" type="submit" value="Check Out">
						</form>
					</div>
				</div>
				
				<table id="tableStyle" class="display" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>Product Name</th>
							<th>quantity</th>
							<th>Price</th>
						</tr>
					</thead>
					<tbody>
						@foreach($items as $item)
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
							<td id="computed_total_price">{{$total_price}}</td>
						</tr>
					</tfoot>
				</table>

				<form action="{{url('/cart/checkout')}}" method="POST" id="payment-form">
					{{csrf_field()}}
					<span class="payment-errors"></span>

					<div class="form-row">
						<label>
							<span>Card Number</span>
							<input type="text" size="20" data-stripe="number" value="4242424242424242">
						</label>
					</div>

					<div class="form-row">
						<label>
							<span>Expiration (MM/YY)</span>
							<input type="text" size="2" data-stripe="exp_month" value="11">
						</label>
						<span> / </span>
						<input type="text" size="2" data-stripe="exp_year" value="18">
					</div>

					<div class="form-row">
						<label>
							<span>CVC</span>
							<input type="text" size="4" data-stripe="cvc" value="111">
						</label>
					</div>
					<input type="submit" class="submit" value="Submit Payment">
				</form>
			</div>
		</div>
	</section>
	<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
	<script type="text/javascript">
		Stripe.setPublishableKey('pk_test_O7ZJNRdOZiR1UG0kCO9QEEE9');

		function stripeResponseHandler(status, response) {
			// Grab the form:
			var $form = $('#payment-form');

			if (response.error) { // Problem!

				// Show the errors on the form:
				$form.find('.payment-errors').text(response.error.message);
				$form.find('.submit').prop('disabled', false); // Re-enable submission

			} else { // Token was created!

				// Get the token ID:
				var token = response.id;

				// Insert the token ID into the form so it gets submitted to the server:
				$form.append($('<input type="hidden" name="stripeToken">').val(token));

				// Submit the form:
				$form.get(0).submit();
			}
		}
		$(function () {
			var $form = $('#payment-form');
			$form.submit(function (event) {
				// Disable the submit button to prevent repeated clicks:
				$form.find('.submit').prop('disabled', true);

				// Request a token from Stripe:
				Stripe.card.createToken($form, stripeResponseHandler);

				// Prevent the form from being submitted:
				return false;
			});
		});
	</script>
	@endsection