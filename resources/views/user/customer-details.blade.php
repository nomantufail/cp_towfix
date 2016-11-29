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
    <section class="vehicle-detail">
        <h2 class="main-heading">Customer Detail</h2>
        <div class="vehicle-widget">
            <ul class="vehicle-info">
                <li>
                    <strong>Customer Name</strong>
                    <span>{{$customer->f_name}} {{$customer->l_name}}</span>
                </li>
                <li>
                    <strong>Customer Email</strong>
                    <span>{{$customer->email}}</span>
                </li>
                <li>
                    <strong>Address</strong>
                    <span>{{$customer->address}}</span>
                </li>
                <li>
                    <strong>Phone Number</strong>
                    <span>{{$customer->phone_number}}</span>
                </li>
            </ul>
            <div class="vehicle-history">
                <h4>Vehicles</h4>
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
                    @foreach($customer->vehicles as $vehicle)
                        <tr>
                            <td data-title="Make">{{$vehicle->make}}</td>
                            <td data-title="Model">{{$vehicle->model}}</td>
                            <td data-title="Customer Name">{{$vehicle->owner->f_name}} {{$vehicle->owner->l_name}}</td>
                            <td data-title="Year">{{$vehicle->year}}</td>
                            <td data-title="Vehicle Type">{{$vehicle->vehicle_type}}</td>
                            <td data-title="Next Service">{{$vehicle->next_service}}</td>
                            <td data-title="Registration #">{{$vehicle->registration_number}}</td>
                            <td data-title="Registration exp">{{$vehicle->registration_expiry}}</td>
                            <td data-title="Details"><a href="{{url('/vehicle/')}}/{{$vehicle->id}}">View</a></td>
                            <td data-title="Actions">
                                @if($user->can('edit','vehicles',$vehicle))<a href="{{url('/')}}/vehicle/update/{{$vehicle->id}}"><i class="fa fa-edit fa-fw"></i></a>@endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection