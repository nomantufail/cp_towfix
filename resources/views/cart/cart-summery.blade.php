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
            <h2>Shopping Summery</h2>
        </div>
        <div class="vehicles-list-content">
            <div class="vehicles-table">
                @if(\Session::has('success'))
                    <h4>
                        {{\Session::get('success')}}
                    </h4>
                @endif

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
        $(function() {
            var $form = $('#payment-form');
            $form.submit(function(event) {
                // Disable the submit button to prevent repeated clicks:
                $form.find('.submit').prop('disabled', true);

                // Request a token from Stripe:
                Stripe.card.createToken($form,stripeResponseHandler);

                // Prevent the form from being submitted:
                return false;
            });
        });
    </script>
@endsection