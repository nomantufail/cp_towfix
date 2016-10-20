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
    <section class="news-panel">
        <h2 class="main-heading">Newsletters</h2>
        <div class="news-listing">
            <ul class="row">
                @foreach($newsletters as $newsletter)
                    <li class="col-md-4 col-sm-4 col-xm-12">
                        <div class="news-widget">
                            <figure>
                                <img src="{{url('/')}}/{{$newsletter->image}}" alt="">
                            </figure>
                            <div class="store-content">
                                <h4>{{$newsletter->name}}</h4>
                                <p>{{$newsletter->detail}}</p>
                                <a href="{{url('/')}}/newsletter/{{$newsletter->id}}">Read More</a>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
@endsection