<?php
/**
 * Created by PhpStorm.
 * User: nomantufail
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

        <div class="next-prev-msg">
            <a href="{{$messages->previousPageUrl()}}"><i class="fa fa-arrow-circle-o-left"></i></a>
            <a href="{{$messages->nextPageUrl()}}"><i class="fa fa-arrow-circle-o-right"></i></a>
            <em>@if($messages->count()<= $messages->perpage()){{$messages->count()}}@else {{$messages->perPage()}}@endif of {{$messages->total()}}</em>
        </div>
        <h2>{{$engagedUser->f_name}} {{$engagedUser->l_name}}</h2>
    </div>
    <ul class="conversation-list">
        @foreach($messages as $message)
        <li class="@if($message->sender_id == $user->id) my-message @endif">
            <div class="user-conversation">
                <h4><span><i class="fa fa-paperclip"></i> {{$message->created_at->toFormattedDateString()}}</span></h4>
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