<?php
/**
 * Created by PhpStorm.
 * User: nomantufail
 * Date: 10/6/2016
 * Time: 3:25 PM
 */
?>
@extends('app')

@section('page')
    <section class="add-vehicle">
        @if(\Session::has('success'))
            <h4>
                {{\Session::get('success')}}
            </h4>
        @endif
        <h2 class="main-heading">Add A Vehicle</h2>
        <div class="add-vehicle-widget">
            {{--@if (sizeof($errors) > 0)--}}
                {{--<div class="alert alert-danger">--}}
                    {{--@foreach ($errors->all() as $error)--}}
                        {{--{{ $error }}<br>--}}
                    {{--@endforeach--}}
                {{--</div>--}}
            {{--@endif--}}
            <form class="add-vehicle-form" method="post" action="{{url('/')}}/vehicle/add">
                {{csrf_field()}}
                <label class="half-field">
                    <span>Make</span>
                    <input type="text" name="make" placeholder="Make">
                    @if ($errors->has('make'))
                        <div class="alert alert-danger">
                            @foreach ($errors->get('make') as $message)
                                {{ $message }}<br>
                            @endforeach
                        </div>
                    @endif
                </label>


                <label class="half-field">
                    <span>Model</span>
                    <input type="text" name="model" placeholder="Model">
                    @if ($errors->has('model'))
                        <div class="alert alert-danger">
                            @foreach ($errors->get('model') as $message)
                                {{ $message }}<br>
                            @endforeach
                        </div>
                    @endif
                </label>

                <label class="full-field">
                    <span>Vehicle Type</span>
                    <select name="vehicle_type_id">
                        <option value="">Select Vehicle Type</option>
                        @foreach($vehicleTypes as $vehicleType)
                            <option value="{{$vehicleType->id}}">{{$vehicleType->vehicle_type}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('vehicle_type_id'))
                        <div class="alert alert-danger">
                            @foreach ($errors->get('vehicle_type_id') as $message)
                                {{ $message }}<br>
                            @endforeach
                        </div>
                    @endif
                </label>

                <label class="half-field">
                    <span>Year</span>
                    <input type="text" class="datetimepicker" name="year" placeholder="Year"/>
                    @if ($errors->has('year'))
                        <div class="alert alert-danger">
                            @foreach ($errors->get('year') as $message)
                                {{ $message }}<br>
                            @endforeach
                        </div>
                    @endif
                </label>

                <label class="half-field">
                    <span>Year Purchased</span>
                    <input type="text" class="datetimepicker" name="year_purchased" placeholder="Year Purchased"/>
                    @if ($errors->has('year_purchased'))
                        <div class="alert alert-danger">
                            @foreach ($errors->get('year_purchased') as $message)
                                {{ $message }}<br>
                            @endforeach
                        </div>
                    @endif
                </label>

                <label class="half-field">
                    <span>Last Service</span>
                    <input type="text" class="datetimepicker" name="last_service" placeholder="Last Service">
                    @if ($errors->has('last_service'))
                        <div class="alert alert-danger">
                            @foreach ($errors->get('last_service') as $message)
                                {{ $message }}<br>
                            @endforeach
                        </div>
                    @endif
                </label>

                <label class="half-field">
                    <span>Next Service</span>
                    <input type="text" class="datetimepicker" name="next_service" placeholder="Next Service">
                    @if ($errors->has('next_service'))
                        <div class="alert alert-danger">
                            @foreach ($errors->get('next_service') as $message)
                                {{ $message }}<br>
                            @endforeach
                        </div>
                    @endif
                </label>

                <label class="half-field">
                    <span>Registration Number</span>
                    <input type="text" name="registration_number" placeholder="Registration Number">
                    @if ($errors->has('registration_number'))
                        <div class="alert alert-danger">
                            @foreach ($errors->get('registration_number') as $message)
                                {{ $message }}<br>
                            @endforeach
                        </div>
                    @endif
                </label>

                <label class="half-field">
                    <span>Registration Expiry</span>
                    <input type="text" class="datetimepicker" name="registration_expiry" placeholder="Registration Expiry">
                    @if ($errors->has('registration_expiry'))
                        <div class="alert alert-danger">
                            @foreach ($errors->get('registration_expiry') as $message)
                                {{ $message }}<br>
                            @endforeach
                        </div>
                    @endif
                </label>

                <label class="half-field">
                    <span>Engine Capacity</span>
                    <input type="text" name="engine_capacity" placeholder="Engine Capacity">
                    @if ($errors->has('engine_capacity'))
                        <div class="alert alert-danger">
                            @foreach ($errors->get('engine_capacity') as $message)
                                {{ $message }}<br>
                            @endforeach
                        </div>
                    @endif
                </label>

                <label class="half-field">
                    <span>Number of Axles</span>
                    <input type="number" name="number_axles" placeholder="Number of Axles">
                    @if ($errors->has('number_axles'))
                        <div class="alert alert-danger">
                            @foreach ($errors->get('number_axles') as $message)
                                {{ $message }}<br>
                            @endforeach
                        </div>
                    @endif
                </label>

                <label>
                    <span>Details</span>
                    <textarea name="details" placeholder="Details"></textarea>
                    @if ($errors->has('details'))
                        <div class="alert alert-danger">
                            @foreach ($errors->get('details') as $message)
                                {{ $message }}<br>
                            @endforeach
                        </div>
                    @endif
                </label>
                <label class="submit">
                    <input type="submit" class="btn btn btn-primary" name="submit" value="Submit">
                </label>
            </form>
        </div>
    </section>
@endsection