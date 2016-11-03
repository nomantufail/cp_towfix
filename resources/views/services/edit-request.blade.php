<?php
/**
 * Created by PhpStorm.
 * user: nomantufail
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/1.5.1/socket.io.min.js"></script>
    <script>
        var socket = io('http://localhost:3000');
        socket.emit('request_editing', {
            request_id:"<?= $request->id ?>",
            user_id: "<?= $user->id ?>"
        });

        socket.on('request-already-locked', function (data) {
            if(data.editing != "<?= $user->id ?>"){
                alert('user# '+data.editing+' has control over this request');
                window.location.href=base_url+"service_requests";
            }
        });
    </script>
@endsection
