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

    <section class="add-vehicle">
        @if(\Session::has('success'))
            <h4 class="alert alert-success fade in">
                {{\Session::get('success')}}
            </h4>
        @endif
        <h2 class="main-heading">Edit A Vehicle</h2>
        <div class="add-vehicle-widget">
            <form class="add-vehicle-form" method="post" action="{{url('/')}}/vehicle/update/{{$vehicle->id}}">
                {{csrf_field()}}
                @if($user->isFranchise())
                <label class="half-field">
                    <span>Change Customer</span>
                    <select name="customer_id" id="customer_id">
                        @foreach($customers as $customer)
                            <option value="{{$customer->id}}" @if($customer->id == $vehicle->customer_id) selected @endif>{{$customer->f_name}} {{$customer->l_name}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('make'))
                        <div class="alert alert-danger">
                            @foreach ($errors->get('make') as $message)
                                {{ $message }}<br>
                            @endforeach
                        </div>
                    @endif
                </label>
                @endif

                <label class="half-field">
                    <span>Make</span>
                    <input type="text" name="make" placeholder="Make" value="{{$vehicle->make}}">
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
                    <input type="text" name="model" placeholder="Model" value="{{$vehicle->model}}">
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
                    <select name="vehicle_type_id" id="vehicle_type">
                        <option value="">Select Vehicle Type</option>
                        @foreach($vehicleTypes as $vehicleType)
                            <option value="{{$vehicleType->id}}" @if($vehicleType->id == $vehicle->vehicle_type_id) selected @endif>{{$vehicleType->vehicle_type}}</option>
                        @endforeach
                    </select>
                </label>

                <label class="half-field">
                    <span>Year</span>
                    {{--<input type="text" id="datetimepicker" name="year" placeholder="Year"/>--}}
                    <?php
                    $startdate = 1960;
                    $enddate = date("Y");
                    $years = range ($startdate,$enddate);
                    ?>
                    <select name="year" id="year">
                        @foreach($years as $year)
                            {
                            <option value="{{$year}}" @if($year == $vehicle->year) selected @endif>{{$year}}</option>
                            }
                        @endforeach
                    </select>

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
                    {{--<input type="text" id="datetimepicker" name="yearPurchased" placeholder="Year Purchased"/>--}}

                    <?php
                    $startdate = 1960;
                    $enddate = date("Y");
                    $years = range ($startdate,$enddate);
                    ?>
                    <select name="year_purchased" id="year_purchased">
                    @foreach($years as $year)
                    {
                            <option value="{{$year}}" @if($year == $vehicle->year_purchased) selected @endif>{{$year}}</option>
                    }
                    @endforeach
                    </select>
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
                    <input type="datetime" class="dateTime" name="last_service" placeholder="Last Service" value="{{$vehicle->last_service}}">
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
                    <input type="datetime" class="dateTime" name="next_service" placeholder="Next Service" value="{{$vehicle->next_service}}">
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
                    <input type="text" name="registration_number" placeholder="Registration Number" value="{{$vehicle->registration_number}}">
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
                    <input type="text" class="date1" name="registration_expiry" placeholder="Registration Expiry" value="{{$vehicle->registration_expiry}}">
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
                    <input type="text" name="engine_capacity" placeholder="Engine Capacity" value="{{$vehicle->engine_capacity}}">
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
                    <input type="text" name="number_axles" placeholder="Number of Axles" value="{{$vehicle->number_axles}}">
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
                    <textarea name="details" placeholder="Details">{{$vehicle->details}}</textarea>
                </label>
                <label class="submit">
                    <input type="submit" class="btn btn btn-primary" name="submit" value="Submit">
                </label>
            </form>
        </div>
    </section>
    <script>
        $(function() {
            $(".date1").datepicker({
                dateFormat: 'yy-mm-dd'
            });
        });

        $('.dateTime').datetimepicker({
            dateFormat:'yy-m-d'
        });

        $("#vehicle_type").select2({
            allowClear: true,
            placeholder: "Select Vehicle Type"

        });
        $("#year").select2({
            allowClear: true,
            placeholder: "Select Year"

        });
        $("#year_purchased").select2({
            allowClear: true,
            placeholder: "Select Purchased Year"

        });
    </script>

@endsection