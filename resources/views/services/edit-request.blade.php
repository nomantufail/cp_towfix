<?php
/**
 * Created by PhpStorm.
 * User: nomantufail
 * Date: 10/24/2016
 * Time: 1:06 PM
 */
?>

@extends('app')

@section('page')
    <section class="frenchies-panel">
        @if(\Session::has('success'))
            <h4>
                {{\Session::get('success')}}
            </h4>
        @endif
        <h2 class="main-heading">Change Request Date</h2>
        <div class="frenchies-widget">
            <form class="frenchies-form" action="{{url('/')}}/service_request/edit/{{$request->id}}" method="post">
                {{csrf_field()}}
                <label>
                    <span>Date/Time</span>
                    <input type="date" placeholder="Date/Time" name="suggested_date" value="{{$request->suggested_date}}">
                </label>
                <label>
                    <span>Message</span>
                    <textarea placeholder="Message" name="message"></textarea>
                </label>
                <input type="submit" class="btn btn-primary" value="Send">
            </form>
        </div>
    </section>
@endsection
