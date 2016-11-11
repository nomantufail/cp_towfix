<?php
/**
 * Created by PhpStorm.
 * user: nomantufail
 * Date: 10/6/2016
 * Time: 3:25 PM
 */
?>
@extends('conversations.messages')

@section('messages-content')
<style>
    .my-message{
        text-align: right;
    }
</style>


    <div class="conversation-head">
        <h2>{{$engagedUser->f_name}} {{$engagedUser->l_name}}</h2>
    </div>
    <ul class="conversation-list">
        @foreach($messages as $message)
        <li class="@if($message->sender_id == $user->id) my-message @endif">
            <div class="user-conversation">
                <em>{{$message->created_at->toFormattedDateString()}} {{$message->created_at->toTimeString()}}</em>
                <p>{{$message->message}}</p>
            </div>
        </li>
        @endforeach
    </ul>
    <div class="conversation-sent">
        <form class="frenchies-form" action="{{url('/')}}/message/send" method="post">
            {{csrf_field()}}
            <input type="hidden" value="{{$engagedUser->id}}" name="receiver">
            <textarea placeholder="Message" name="message"></textarea>
            <input type="submit" name="sentMessage" value="Send">
        </form>
    </div>
@endsection