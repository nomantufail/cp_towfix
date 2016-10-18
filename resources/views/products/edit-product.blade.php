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
            <form class="add-vehicle-form" method="post" action="{{url('/')}}/vehicle/add">
                {{csrf_field()}}
                <label class="half-field">
                    <span>Make</span>
                    <input type="text" name="Make" placeholder="Make">
                </label>

                <label class="half-field">
                    <span>Model</span>
                    <input type="text" name="Model" placeholder="Model">
                </label>

                <label class="full-field">
                    <span>Vehicle Type</span>
                    <select name="vehicle_type_id">
                        <option value="">Select Vehicle Type</option>
                        @foreach($vehicleTypes as $vehicleType)
                            <option value="{{$vehicleType->id}}">{{$vehicleType->vehicle_type}}</option>
                        @endforeach
                    </select>
                </label>

                <label class="half-field">
                    <span>Year</span>
                    <input type="text" class="datetimepicker" name="year" placeholder="Year"/>
                </label>

                <label class="half-field">
                    <span>Year Purchased</span>
                    <input type="text" class="datetimepicker" name="yearPurchased" placeholder="Year Purchased"/>
                </label>

                <label class="half-field">
                    <span>Last Service</span>
                    <input type="text" class="datetimepicker" name="lastService" placeholder="Last Service">
                </label>

                <label class="half-field">
                    <span>Next Service</span>
                    <input type="text" class="datetimepicker" name="nextService" placeholder="Next Service">
                </label>

                <label class="half-field">
                    <span>Registration Number</span>
                    <input type="text" name="registrationNumber" placeholder="Registration Number">
                </label>

                <label class="half-field">
                    <span>Registration Expiry</span>
                    <input type="text" class="datetimepicker" name="registrationExpiry" placeholder="Registration Expiry">
                </label>

                <label class="half-field">
                    <span>Engine Capacity</span>
                    <input type="text" name="engineCapacity" placeholder="Engine Capacity">
                </label>

                <label class="half-field">
                    <span>Number of Axles</span>
                    <input type="text" name="numberAxles" placeholder="Number of Axles">
                </label>

                <label>
                    <span>Details</span>
                    <textarea name="" placeholder="Details"></textarea>
                </label>
                <label class="submit">
                    <input type="submit" class="btn btn btn-primary" name="submit" value="Submit">
                </label>
            </form>
        </div>
    </section>
@endsection