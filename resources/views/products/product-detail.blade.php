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
                <a href="#" class="btn btn-primary">Buy Product</a>
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Contact to Frenchise</a>
            </div>
        </div>
    </section>
<script>
    $('.bxslider').bxSlider({
        pagerCustom: '#bx-pager'
    });
</script>
@endsection
