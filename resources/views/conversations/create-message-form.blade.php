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
    <section class="frenchies-panel">
        @if(\Session::has('success'))
            <h4 class="alert alert-success fade in">
                {{\Session::get('success')}}
            </h4>
        @endif
        <h2 class="main-heading">Contact a @if(Auth::user()->isCustomer()) Franchise @else Customer @endif</h2>
        <div class="frenchies-widget">
            <form class="frenchies-form" action="{{url('/')}}/message/send" method="post">
                {{csrf_field()}}
                <label>
                    <span>@if(Auth::user()->isCustomer()) Franchises @else Customers @endif:</span>
                    <select name="receiver">
                        @foreach($receivers as $receiver)
                            <option value="{{$receiver->id}}">
                                {{$receiver->f_name." ".$receiver->l_name}}
                            </option>
                        @endforeach
                    </select>
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