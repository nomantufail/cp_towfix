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
    <section class="news-panel">
        <h2 class="main-heading">Newsletters</h2>
        <div class="news-listing">
            <ul class="row">
                @foreach($newsletters as $newsletter)
                    <li class="col-md-4 col-sm-4 col-xm-12">
                        <div class="news-widget">
                            <figure>
                                @if(count($newsletter->images->all()))
                                <img src="{{url('/')}}/{{$newsletter->images->all()[0]->path}}" alt="">
                                @endif
                            </figure>
                            <div class="store-content">
                                <h4>{{$newsletter->name}}</h4>
                                <p>{{str_limit($newsletter->detail, 150)}}</p>
                                <a href="{{url('/')}}/newsletter/{{$newsletter->id}}">Read More</a>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            $(".fancybox").fancybox();
        });
    </script>
@endsection