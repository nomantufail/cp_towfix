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
    <section class="vehicles-list">
        <div class="vehicles-head">
            <h3>@if($user->isCustomer())My @else Customer @endif Service Requests</h3>
            <a href="{{url('/')}}/service_request/create" class="btn btn-primary pull-right">Add a New Service</a>
        </div>
        <div class="vehicles-list-content">
            <div class="vehicles-table">
                <table id="tableStyle" class="display" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        @if($user->isFranchise())<th>Customer Name</th>@endif
                        <th>Vehicle</th>
                        <th>Membership Number</th>
                        @if($user->isCustomer())<th>Franchise Name</th>@endif
                        @if($user->isCustomer())<th>Franchise Area</th>@endif
                        <th>Date/Time</th>
                        <th>Details</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody id="requests">
                    @foreach($requests as $request)
                    <tr data-req-id="{{$request->id}}">
                        @if($user->isFranchise())<th>{{$request->customer->f_name}} {{$request->customer->l_name}}</th>@endif
                        <td>{{$request->vehicle->make}} {{$request->vehicle->model}}</td>
                            <td>24574</td>
                        @if($user->isCustomer())<th>{{$request->franchise->f_name}} {{$request->franchise->l_name}}</th>@endif
                        @if($user->isCustomer())<th>Area</th>@endif
                        <td>{{\Carbon\Carbon::createFromFormat('Y-m-d h:i:s',$request->suggested_date)->toFormattedDateString()}}
                            @if($request->isPending())
                            <span style="color:@if($request->suggestedUser->id == $user->id) green @else red @endif; font-weight: bold;">
                                By
                                @if($request->suggestedUser->id == $user->id)
                                    <span data-toggle="tooltip" title="{{$request->message}}">You</span>
                                @else
                                    @if($request->suggestedUser->isFranchise())
                                        <span data-toggle="tooltip" title="{{$request->message}}">Franchise</span>
                                    @else
                                        <span data-toggle="tooltip" title="{{$request->message}}">Customer</span>
                                    @endif
                                @endif
                            </span>
                            @endif
                        </td>
                        <td><a href="{{url('/vehicle/')}}/{{$request->vehicle->id}}">View</a></td>
                        <td>{{$request->getStatus()}}</td>
                        <td>
                            <span class="whats-happening"></span>
                            @if($user->can('accept','serviceRequest', $request))<form class="accept-request" method="post" action="{{url('/')}}/service_request/accept/{{$request->id}}">{{csrf_field()}}<button><i class="fa fa-check fa-fw"></i></button></form>@endif
                                @if($user->can('delete','serviceRequest', $request))<form class="delete-request" data-req-id="{{$request->id}}"  method="post" action="{{url('/')}}/service_request/delete/{{$request->id}}">{{csrf_field()}}<button><i class="fa fa-close fa-fw"></i></button></form>@endif
                            @if($user->can('edit','serviceRequest', $request))<a class="edit-link" href="{{url('/')}}/service_request/edit/{{$request->id}}"><i class="fa fa-edit fa-fw"></i></a>@endif
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/1.5.1/socket.io.min.js"></script>
    <script>
        var socket = io('http://localhost:3000');
        socket.emit('load-test','');
        socket.on('request-under-updating', function (data) {
            $.each( data.sockets, function( key, value ) {
                var request = $("#requests tr[data-req-id='"+value.request_id+"']");
                request.find('.edit-link').hide();
                request.find('.delete-request').hide();
                request.find('.accept-request').hide();
                request.find('.whats-happening').text('editing...');
            });
        });
        socket.on('request-locked', function (data) {
            if(data.editing != "<?= $user->id ?>"){
                var request = $("#requests tr[data-req-id='"+data.request_id+"']");
                request.find('.edit-link').hide();
                request.find('.delete-request').hide();
                request.find('.accept-request').hide();
                request.find('.whats-happening').text('editing...');
            }
        });
        socket.on('request-released', function (data) {
            var request = $("#requests tr[data-req-id='"+data.request_id+"']");
            request.find('.edit-link').show();
            request.find('.delete-request').show();
            request.find('.accept-request').show();
            request.find('.whats-happening').text('');
        });
        $(document).ready(function () {

        });
    </script>
@endsection
