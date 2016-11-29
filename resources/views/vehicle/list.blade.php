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
    <section class="vehicles-list">
        <div class="vehicles-head">
            <h3>Your Vehicles</h3>
            @if($user->can('add', 'vehicles'))<a href="{{url('/')}}/vehicle/add" class="btn btn-primary pull-right">Add a Vehicle</a>@endif
        </div>
        <div class="vehicles-list-content">
            <div class="vehicles-table">
                <table id="tableStyle" class="display" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Make</th>
                        <th>Model</th>
                        <th>Customer Name</th>
                        <th>Year</th>
                        <th>Vehicle Type</th>
                        <th>Next Service</th>
                        <th>Registration Number</th>
                        <th>Registration Expiry</th>
                        <th>Detail</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($vehicles as $vehicle)
                        <tr>
                            <td>{{$vehicle->make}}</td>
                            <td>{{$vehicle->model}}</td>
                            <td>{{$vehicle->owner->f_name}} {{$vehicle->owner->l_name}}</td>
                            <td>{{$vehicle->year}}</td>
                            <td>{{$vehicle->vehicle_type}}</td>
                            <td>{!! \App\Libs\Helpers\Helper::towfixDateFormat($vehicle->next_service) !!}</td>
                            <td>{{$vehicle->registration_number}}</td>
                            <td>{!! \App\Libs\Helpers\Helper::towfixDateFormat($vehicle->registration_expiry) !!}</td>
                            <td><a href="{{url('/vehicle/')}}/{{$vehicle->id}}">View</a></td>
                            <td>
                                @if($user->can('edit','vehicles',$vehicle))<a href="{{url('/')}}/vehicle/update/{{$vehicle->id}}"><i class="fa fa-edit fa-fw"></i></a>@endif
                                @if($user->can('delete','vehicles',$vehicle))<form method="post" action="{{url('/')}}/vehicle/delete">{{csrf_field()}}<input type="hidden" value="{{$vehicle->id}}" name="id"><button><i class="fa fa-trash fa-fw"></i></button></form>@endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection