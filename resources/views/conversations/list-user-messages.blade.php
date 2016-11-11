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
                <ul class="attachment">
                	<li>
                		<a class="fancybox" href="{{url('/')}}/images/store-img.jpg">
                			<img src="{{url('/')}}/images/store-img.jpg" alt="">
                		</a>
                	</li>
                	<li>
                		<a class="fancybox" href="{{url('/')}}/images/profile.jpg.jpg">
                			<img src="{{url('/')}}/images/profile.jpg.jpg" alt="">
                		</a>
                	</li>
                	<li>
                		<a class="fancybox" href="{{url('/')}}/images/store-img.jpg">
                			<img src="{{url('/')}}/images/store-img.jpg" alt="">
                		</a>
                	</li>
                	<li>
                		<a class="fancybox" href="{{url('/')}}/images/profile.jpg">
                			<img src="{{url('/')}}/images/profile.jpg" alt="">
                		</a>
                	</li>
                </ul>
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
            <input type="file" name="">
        </form>
    </div>
    <script>
		$(document).ready(function() {
            $(".fancybox").fancybox();
        });
	</script>
@endsection