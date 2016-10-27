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
    <section class="add-vehicle">
        @if(\Session::has('success'))
            <h4>
                {{\Session::get('success')}}
            </h4>
        @endif
        <h2 class="main-heading">Request a Service</h2>
        <div class="add-vehicle-widget">
            <form class="add-vehicle-form" method="post" action="{{url('/')}}/service_request/create">
                {{csrf_field()}}
                <label class="half-field">
                    <span>Select Vehicle</span>
                    <select name="vehicle_id">
                        @foreach($vehicles as $vehicle)
                            <option value="{{$vehicle->id}}">
                                {{$vehicle->make}} {{$vehicle->model}}
                            </option>
                        @endforeach
                    </select>
                </label>

                <label class="half-field">
                    <span>Select Franchise</span>
                    <select name="franchise_id">
                    @foreach($franchises as $franchise)
                        <option value="{{$franchise->id}}">
                            {{$franchise->f_name}} {{$franchise->l_name}}
                        </option>
                    @endforeach
                    </select>
                </label>

                <label class="half-field">
                    <span>Type Of Work Required</span>
                    <select name="work_type_id">
                        @foreach($work_types as $work_type)
                            <option value="{{$work_type->id}}">
                                {{$work_type->work_type}}
                            </option>
                        @endforeach
                    </select>
                </label>

                <label class="half-field">
                    <span>Service Date</span>
                    <input type="datetime" name="suggested_date" placeholder="date" value="2014-02-02">
                </label>
                <label class="submit">
                    <input type="submit" class="btn btn btn-primary" name="submit" value="Send">
                </label>
            </form>
        </div>
    </section>
@endsection
