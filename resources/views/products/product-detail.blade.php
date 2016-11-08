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
    <section class="product-detail">
        <div class="product-widget">

            @if(count($product->images))
            <div class="product-slider">
                <ul class="bxslider">
                    @foreach($product->images as $image)
                        <li><img src="{{url('/')}}/{{$image->path}}" /></li>
                    @endforeach
                </ul>

                <div id="bx-pager">
                    <?php
                        $count = 0;
                    foreach($product->images as $image){
                     ?>
                        <a data-slide-index="{{$count}}" href=""><img src="{{url('/')}}/{{$image->path}}" /></a>
                    <?php
                            $count++;
                    }
                    ?>
                </div>
            </div>
            @endif
            <div class="product-info">
                <h4>{{$product->name}}</h4>
                <label>Product Price: <span>${{$product->price}}</span></label>
                <p>{{$product->detail}}</p>
                @if(!$product->is_poster)<span data-id="{{$product->id}}" class="btn btn-primary @if(in_array($product->id,$productsInCart)) added_to_cart @else add_to_cart @endif">Add To Cart</span>@endif
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Contact to Frenchise</a>
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
    })

    $('.bxslider').bxSlider({
        pagerCustom: '#bx-pager'
    });
</script>
@endsection
