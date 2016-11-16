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
							</ul>
							@foreach($items as $item)
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
								<span>${{$total_price}}</span>
							</div>
						</div>
					</div>
					<div class="payment-widget">
						<h4>Credit Card Information</h4>
						<form action="{{url('/cart/checkout')}}" method="POST" id="payment-form">
							{{csrf_field()}}
							<label>
								<span>Card Number</span>
								<input type="text" size="20" data-stripe="number" placeholder="Enter Your Card Number" value="4242424242424242">
							</label>
							<label class="half-field">
								<span>Expiration (MM/YY)</span>
								<input type="text" name="" value="11" data-stripe="exp_month" placeholder="Month"> /
								<input type="text" name="" value="18" data-stripe="exp_year" placeholder="Year">
							</label>
							<label>
								<span>CVC Code</span>
								<input type="text" name="" data-stripe="cvc" placeholder="Enter CVC Code" value="111">
							</label>
							<input class="cart-btn" type="submit" value="Check Out">
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
	<script type="text/javascript">
		Stripe.setPublishableKey('<?= env('STRIPE_PUBLISHABLE_KEY') ?>');

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