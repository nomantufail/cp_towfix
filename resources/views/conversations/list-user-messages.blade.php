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
        <li class="@if($message[0]->sender_id == $user->id) my-message @endif">
            <div class="user-conversation">
                <em>{{$message[0]->created_at->toFormattedDateString()}} {{$message[0]->created_at->toTimeString()}}</em>
                <p>{{$message[0]->message}}</p>
                @if($message[0]->path != "")
                <ul class="attachment">
                	@foreach($message as $image)
                    <li>
                		<a class="fancybox" href="{{url('/')}}/{{$image->path}}">
                			<img src="{{url('/')}}/{{$image->path}}" alt="">
                		</a>
                	</li>
                    @endforeach
                </ul>
                @endif
            </div>
        </li>
        @endforeach
    </ul>
    <div class="conversation-sent">
        <form class="frenchies-form" action="{{url('/')}}/message/send" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <input type="hidden" value="{{$engagedUser->id}}" name="receiver">
            <textarea placeholder="Message" name="message"></textarea>
            <input type="submit" name="sentMessage" value="Send">
            <input type="file" name="images[]" multiple>
            @if ($errors->has('images'))
                <div class="alert alert-danger">
                    @foreach ($errors->get('images') as $message)
                        {{ $message }}<br>
                    @endforeach
                </div>
            @endif
        </form>
    </div>
    <script>
		$(document).ready(function() {
            $(".fancybox").fancybox();
        });
	</script>
@endsection