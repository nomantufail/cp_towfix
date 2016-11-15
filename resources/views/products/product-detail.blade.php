<?php
/**
 * Created by PhpStorm.
 * user: nomantufail
 * Date: 10/18/2016
 * Time: 3:40 PM
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
    <section class="product-detail">
        <div class="product-widget">
            @if(count($product->images))
            <div class="product-slider">
               	<ul class="product-list-images">
               		@foreach($product->images as $image)
               		<li>
               			<a class="fancybox" href="{{url('/')}}/{{$image->path}}">
               				<img src="{{url('/')}}/{{$image->path}}" />
               			</a>
               		</li>
               		@endforeach
               	</ul>
            </div>
            @endif
            <div class="product-info">
                <h4>{{$product->name}}</h4>
                @if($product->is_poster)
                    <label>Contact: <span>{{$product->contact}}</span></label><br>
                    <label>Email: <span>{{$product->email}}</span></label><br>
                    <label>Address: <span>{{$product->address}}</span></label><br><br>
                @else
                    <label>Product Price: <span>${{$product->price}}</span></label>
                @endif
                <p>{{$product->detail}}</p>

                @if(!$product->is_poster)
                    <span data-id="{{$product->id}}" class="btn btn-primary @if(in_array($product->id,$productsInCart)) added_to_cart @else add_to_cart @endif">@if(in_array($product->id,$productsInCart)) Added To Cart @else Add To Cart @endif</span>
                @endif
            </div>
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
    });
	$(document).ready(function() {
		$(".fancybox").fancybox();
	});

    /*$('.bxslider').bxSlider({
        pagerCustom: '#bx-pager',
        adaptiveHeight: true
    });*/
</script>
@endsection
