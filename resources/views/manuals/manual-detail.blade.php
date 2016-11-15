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
            @if(count($manual->images))
                <div class="product-slider">
                    <ul class="product-list-images">
                        @foreach($manual->images as $image)
                            <li>
                                <a class="fancybox" href="{{url('/')}}/{{$image->image}}">
                                    <img src="{{url('/')}}/{{$image->image}}" />
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="product-info">
                <h4>{{$manual->title}}</h4>
                <p>{{$manual->description}}</p>
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
