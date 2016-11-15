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
            @if(count($newsletter->images))
                <div class="product-slider">
                    <ul class="product-list-images">
                        @foreach($newsletter->images as $image)
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
                <h4>{{$newsletter->name}}</h4>
                <p>{{$newsletter->detail}}</p>
            </div>
        </div>
    </section>
    <script>

        $(document).ready(function() {
            $(".fancybox").fancybox();
        });

        /*$('.bxslider').bxSlider({
         pagerCustom: '#bx-pager',
         adaptiveHeight: true
         });*/
    </script>
@endsection
