<?php
/**
 * Created by PhpStorm.
 * User: nomantufail
 * Date: 10/6/2016
 * Time: 3:25 PM
 */
?>
@extends('app')

@section('page')
    <section class="add-vehicle">
        @if(\Session::has('success'))
            <h4>
                {{\Session::get('success')}}
            </h4>
        @endif
            <h2 class="main-heading">Add A Product</h2>
            <div class="add-vehicle-widget">
                <form class="add-vehicle-form" method="post" action="{{url('/')}}/product/add" enctype="multipart/form-data">
                    {{csrf_field()}}

                    <label>
                        <span>Product Name</span>
                        <input type="text" name="name" placeholder="Product Name">
                    </label>

                    <label class="half-field">
                        <span>Product Price/Product Ad</span>
                        <input type="text" name="price" placeholder="Price" class="product-price">
                    </label>

                    <label class="half-field select-ad-field">
                        <span><input type="radio" name="contactPoster">Contact Ad Poster</span>
                    </label>

                    <div class="select-field" style="display:none;">
                        <label class="half-field">
                            <span>Contact Number</span>
                            <input type="text" name="contactNumber" placeholder="Contact Number">
                        </label>
                        <label class="half-field">
                            <span>Contact Email</span>
                            <input type="text" name="contactEmail" placeholder="Contact Email">
                        </label>
                        <label>
                            <span>Contact Address</span>
                            <input type="text" name="contactAddress" placeholder="Contact Address">
                        </label>
                    </div>

                    <label style="clear: both">
                        <span>Detail</span>
                        <textarea name="detail" placeholder="Detail"></textarea>
                    </label>
                    <label style="clear: both">
                        <input type="file" name="images[]" multiple>
                    </label>
                    <label class="submit">
                        <input type="submit" class="btn btn btn-primary" name="submit" value="Submit">
                    </label>
                </form>
            </div>
    </section>
@endsection