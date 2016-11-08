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

            @if(count($manual->images))
                <div class="product-slider">
                    <ul class="bxslider">
                        @foreach($manual->images as $image)
                            <li><img src="{{url('/')}}/{{$image->image}}" /></li>
                        @endforeach
                    </ul>

                    <div id="bx-pager">
                        <?php
                        $count = 0;
                        foreach($manual->images as $image){
                        ?>
                        <a data-slide-index="{{$count}}" href=""><img src="{{url('/')}}/{{$image->image}}" /></a>
                        <?php
                        $count++;
                        }
                        ?>
                    </div>
                </div>
            @endif
            <div class="product-info">
                <h4>{{$manual->title}}</h4>
                <p>{{$manual->description}}</p>
            </div>
        </div>
    </section>
    <script>
        $('.bxslider').bxSlider({
            pagerCustom: '#bx-pager'
        });
    </script>
@endsection
