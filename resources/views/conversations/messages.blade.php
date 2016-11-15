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
    <section class="message-panel">
        <div class="message-widget">
            <span>My Conversation <i class="fa fa-navicon mobile-conv"></i></span>
            <ul class="tabs users-list">
                <div class="conversation-panel">
                    <label class="msg-search">
                        <input type="text" name="msgSearch" id="usersFilter" placeholder="Search">
                        <i class="fa fa-search"></i>
                    </label>
                    <a href="{{url('/')}}/create-new-message">Start a New Conversation</a>

                </div>
                @foreach($users as $user)
                    <li class="tab-link current" data-tab="tab-1">
                        <div class="msg-check">
                            <input type="checkbox" name="checkbox">
                        </div>
                        <div class="msg-text">
                            <a href="{{url('/')}}/messages/{{$user->id}}">
                                <h4>{{$user->f_name}} {{$user->l_name}}</h4>
                            </a>
                        </div>
                    </li>
                @endforeach
            </ul>

            <div id="tab-1" class="tab-content current">
                @yield('messages-content')
            </div>
        </div>
    </section>
    <script>
        jQuery("#usersFilter").keyup(function () {
            var filter = jQuery(this).val();
            jQuery(".users-list li").each(function () {
                if (jQuery(this).text().search(new RegExp(filter, "i")) < 0) {
                    jQuery(this).hide();
                } else {
                    jQuery(this).show()
                }
            });
        });
    </script>
@endsection