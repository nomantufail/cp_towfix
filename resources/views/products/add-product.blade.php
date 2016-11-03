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
                        <input type="text" name="name" placeholder="Product Name" value="{{old('name')}}">
                        @if ($errors->has('name'))
                            <div class="alert alert-danger">
                                @foreach ($errors->get('name') as $message)
                                    {{ $message }}<br>
                                @endforeach
                            </div>
                        @endif
                    </label>

                    <label id="product_price"  class="half-field">
                        <span>Product Price/Product Ad</span>
                        <input type="number" name="price" placeholder="Price" class="product-price" value="{{old('price')}}">
                        @if ($errors->has('price'))
                            <div class="alert alert-danger">
                                @foreach ($errors->get('price') as $message)
                                    {{ $message }}<br>
                                @endforeach
                            </div>
                        @endif
                    </label>

                    <label class="half-field select-ad-field">
                        <span><input id="ad" value="1"  type="checkbox" name="contact_poster" @if (old('contact_poster') == "1") checked @endif>Contact Ad Poster</span>
                    </label>

                    <div id="ad_form" class="select-field" style="display:none;">
                        <label class="half-field">
                            <span>Contact Number</span>
                            <input type="number" name="contact" placeholder="Contact Number" value="{{old('contact')}}">
                            @if ($errors->has('contact'))
                                <div class="alert alert-danger">
                                    @foreach ($errors->get('contact') as $message)
                                        {{ $message }}<br>
                                    @endforeach
                                </div>
                            @endif
                        </label>
                        <label class="half-field">
                            <span>Contact Email</span>
                            <input type="text" name="email" placeholder="Contact Email" value="{{old('email')}}">
                            @if ($errors->has('email'))
                                <div class="alert alert-danger">
                                    @foreach ($errors->get('email') as $message)
                                        {{ $message }}<br>
                                    @endforeach
                                </div>
                            @endif
                        </label>
                        <label>
                            <span>Contact Address</span>
                            <input type="text" name="address" placeholder="Contact Address" value="{{old('address')}}">
                            @if ($errors->has('address'))
                                <div class="alert alert-danger">
                                    @foreach ($errors->get('address') as $message)
                                        {{ $message }}<br>
                                    @endforeach
                                </div>
                            @endif
                        </label>
                    </div>

                    <label style="clear: both">
                        <span>Detail</span>
                        <textarea name="detail" placeholder="Detail">{{old('detail')}}</textarea>
                        @if ($errors->has('detail'))
                            <div class="alert alert-danger">
                                @foreach ($errors->get('detail') as $message)
                                    {{ $message }}<br>
                                @endforeach
                            </div>
                        @endif
                    </label>
                    <label style="clear: both">
                        <input type="file" name="images[]" multiple>
                        @if ($errors->has('images'))
                            <div class="alert alert-danger">
                                @foreach ($errors->get('images') as $message)
                                    {{ $message }}<br>
                                @endforeach
                            </div>
                        @endif
                    </label>
                    <label class="submit">
                        <input type="submit" class="btn btn btn-primary" name="submit" value="Submit">
                    </label>
                </form>
            </div>
    </section>
@endsection