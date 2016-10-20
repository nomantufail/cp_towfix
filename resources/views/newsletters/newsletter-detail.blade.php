<?php
/**
 * Created by PhpStorm.
 * User: nomantufail
 * Date: 10/18/2016
 * Time: 3:40 PM
 */
?>

@extends('app')
@section('page')
    <section class="news-panel">
        <div class="news-detail">
            @if($newsletter->image != "")
            <div class="news-img">
                <figure><img src="{{url('/')}}/{{$newsletter->image}}" alt=""></figure>
            </div>
            @endif
            <div class="news-text">
                <h4>{{$newsletter->name}}</h4>
                <p>{{$newsletter->detail}}</p>
            </div>
        </div>
    </section>
@endsection
