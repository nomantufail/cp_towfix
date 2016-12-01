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
<section class="home-page">
    <div class="banner">
        <img src="{{url('/')}}/images/newBanner.jpg" alt="">
    </div>
    <div class="home-content">
        <h3>Welcome to Towfix the mobile caravan and trailer service that comes to you.</h3>
        <h4>"We come to you for your convenience"</h4>
        <p>Tow Fix is Australia's only mobile caravan, trailer and horse float service and repair franchise. We service all types of caravans, pop-tops and campers, all sorts of trailers including boat, car, work, jet ski and horse floats....in fact anything you can tow! And we do it all at your home, caravan park or storage yard!</p>
        <p>So next time you require a service or repair on your van, trailer or float, don't have the hassle of hooking up and taking it to a workshop... let our workshop come to you!</p>
        <span>Franchises Now Available</span>
        <a href="http://towfix.com.au/">
            <img class="homelogo" src="{{url('/')}}/images/maillogo.jpg" alt="">
        </a>

    </div>
</section>
@endsection