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
        <h2 class="main-heading">Edit A Product</h2>
        <div class="add-vehicle-widget">
            <form class="add-vehicle-form" method="post" action="{{url('/')}}/product/update/{{$product->id}}">
                {{csrf_field()}}


                <label>
                    <span>Product Name</span>
                    <input type="text" name="name" placeholder="Product Name" value="{{$product->name}}">
                    @if ($errors->has('name'))
                        <div class="alert alert-danger">
                            @foreach ($errors->get('name') as $message)
                                {{ $message }}<br>
                            @endforeach
                        </div>
                    @endif
                </label>

                @if($product->is_poster == 0)
                <label id="product_price"  class="half-field">
                    <span>Product Price/Product Ad</span>
                    <input type="number" name="price" placeholder="Price" class="product-price" value="{{$product->price}}">
                    @if ($errors->has('price'))
                        <div class="alert alert-danger">
                            @foreach ($errors->get('price') as $message)
                                {{ $message }}<br>
                            @endforeach
                        </div>
                    @endif
                </label>
                @endif

                <label class="half-field select-ad-field">
                    <span><input id="ad" value="1"  type="checkbox" name="contact_poster" @if ($product->is_poster == 1) checked @endif>Contact Ad Poster</span>
                </label>

                @if($product->is_poster == 1)
                <div id="ad_form" class="select-field" style="display:none;">
                    <label class="half-field">
                        <span>Contact Number</span>
                        <input type="number" name="contact" placeholder="Contact Number" value="{{$product->contact}}">
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
                        <input type="text" name="email" placeholder="Contact Email" value="{{$product->email}}">
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
                        <input type="text" name="address" placeholder="Contact Address" value="{{$product->address}}">
                        @if ($errors->has('address'))
                            <div class="alert alert-danger">
                                @foreach ($errors->get('address') as $message)
                                    {{ $message }}<br>
                                @endforeach
                            </div>
                        @endif
                    </label>
                </div>
                @endif
                <label style="clear: both">
                    <span>Detail</span>
                    <textarea name="detail" placeholder="Detail">{{$product->detail}}</textarea>
                    @if ($errors->has('detail'))
                        <div class="alert alert-danger">
                            @foreach ($errors->get('detail') as $message)
                                {{ $message }}<br>
                            @endforeach
                        </div>
                    @endif
                </label>

                @foreach($productImages as $img)
                    <img id="image_path" src="{{ url('/').$img->path }}" />
                    <input type="button" class="btn btn btn-primary" id="delete_image" value="Delete">
                    <input type="hidden" id="record_id" value="{{$img->id}}">
                @endforeach

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


    <script>


        $(function() {
            if($('#image_path').length){
                $('#file_chooser').hide();
            }
        } );

        $(document).on("click", "#delete_image", function () {

            var path = $('#image_path').attr('src');
            var id = $("#record_id").val();
            deleteImage(path , id);

        });

        function deleteImage(path , id)
        {
            console.log('yes');
            $.ajax({

                type: 'POST' ,
                data: {path: path , id: id, _token:"<?= csrf_token() ?>" },
                url: base_url + 'productDeleteImage' ,
                success: function (data)
                {
                    $('#file_chooser').show();
                    $("#delete_image").hide();
                    $("#image_path").hide();
                }
            });

        }
    </script>
@endsection