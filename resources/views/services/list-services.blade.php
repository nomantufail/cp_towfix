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
                            <span style="color:@if($request->suggestedUser->id && $user->id) green @else red @endif; font-weight: bold;">
                                By
                                @if($request->suggestedUser->id && $user->id)
                                    You
                                @else
                                    @if($request->suggestedUser->isFranchise())
                                        Franchise
                                    @else
                                        Customer
                                    @endif
                                @endif
                            </span>
                        </td>
                        <td><a href="#">View</a></td>
                        <td>{{$request->getStatus()}}</td>
                        <td>
                            @if($request->suggestedUser->id != $user->id)<a href="#"><i class="fa fa-check fa-fw"></i></a>@endif
                            <a href="#"><i class="fa fa-close fa-fw"></i></a>
                            <a href="status-request.html"><i class="fa fa-edit fa-fw"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
