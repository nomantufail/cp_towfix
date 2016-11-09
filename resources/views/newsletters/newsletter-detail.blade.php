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
            @if(count($newsletter->images))
                <div class="product-slider">
                    <ul class="bxslider">
                        @foreach($newsletter->images as $image)
                            <li><img src="{{url('/')}}/{{$image->path}}" /></li>
                        @endforeach
                    </ul>

                    <div id="bx-pager">
                        <?php
                        $count = 0;
                        foreach($newsletter->images as $image){
                        ?>
                        <a data-slide-index="{{$count}}" href=""><img src="{{url('/')}}/{{$image->path}}" /></a>
                        <?php
                        $count++;
                        }
                        ?>
                    </div>
                </div>
            @endif
            <div class="news-text">
                <h3>{{$newsletter->name}}</h3>
                <p>{{$newsletter->detail}}</p>
            </div>
        </div>
    </section>
    <script>
        $('.bxslider').bxSlider({
            pagerCustom: '#bx-pager'
        });
    </script>
@endsection
