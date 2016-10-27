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
    <style>
        .tooltip {
            position: relative;
            display: inline-block;
            border-bottom: 1px dotted black;
        }

        .tooltip .tooltiptext {
            visibility: hidden;
            width: 120px;
            background-color: black;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 5px 0;

            /* Position the tooltip */
            position: absolute;
            z-index: 1;
        }

        .tooltip:hover .tooltiptext {
            visibility: visible;
        }
    </style>
    <section class="vehicles-list">
        <div class="vehicles-head">
            <h3>@if($user->isCustomer()))My @else Customer @endif Service Requests</h3>
        </div>
        <div class="vehicles-list-content">
            <div class="vehicles-table">
                <table id="tableStyle" class="display" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        @if($user->isFranchise())<th>Customer Name</th>@endif
                        <th>Membership Number</th>
                        @if($user->isCustomer())<th>Franchise Name</th>@endif
                        @if($user->isCustomer())<th>Franchise Area</th>@endif
                        <th>Date/Time</th>
                        <th>Details</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($requests as $request)
                    <tr>
                        @if($user->isFranchise())<th>{{$request->customer->f_name}} {{$request->customer->l_name}}</th>@endif
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
                        <td><a href="#">View</a></td>
                        <td>{{$request->getStatus()}}</td>
                        <td>
                            @if($user->can('accept','serviceRequest', $request))<form method="post" action="{{url('/')}}/service_request/accept/{{$request->id}}">{{csrf_field()}}<button><i class="fa fa-check fa-fw"></i></button></form>@endif
                                @if($user->can('delete','serviceRequest', $request))<form method="post" action="{{url('/')}}/service_request/delete/{{$request->id}}">{{csrf_field()}}<button><i class="fa fa-close fa-fw"></i></button></form>@endif
                            @if($user->can('edit','serviceRequest', $request))<a class="edit-link" data-req-id="{{$request->id}}" href="{{url('/')}}/service_request/edit/{{$request->id}}"><i class="fa fa-edit fa-fw"></i></a>@endif
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
        socket.on('request-locked', function (data) {
            if(data.editing != "<?= $user->id ?>"){
                $('.edit-link').each(function () {
                    if(parseInt($(this).attr('data-req-id')) == parseInt(data.request_id)){
                        $(this).hide();
                    }
                });
            }
        });
        socket.on('request-released', function (data) {
            $('.edit-link').each(function () {
                if(parseInt($(this).attr('data-req-id')) == parseInt(data.request_id)){
                    $(this).show();
                }
            });
        });
    </script>
@endsection
