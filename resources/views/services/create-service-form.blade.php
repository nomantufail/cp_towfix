<?php
/**
 * Created by PhpStorm.
 * user: nomantufail
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
                    <select name="vehicle_id" id="vehicle_type">
                        @foreach($vehicles as $vehicle)
                            <option value="{{$vehicle->id}}">
                                {{$vehicle->make}} {{$vehicle->model}}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('vehicle_id'))
                        <div class="alert alert-danger">
                            @foreach ($errors->get('vehicle_id') as $message)
                                {{ $message }}<br>
                            @endforeach
                        </div>
                    @endif
                </label>

                <label class="half-field">
                    <span>Select Franchise</span>
                    <select name="franchise_id" id="franchise">
                    @foreach($franchises as $franchise)
                        <option value="{{$franchise->id}}">
                            {{$franchise->f_name}} {{$franchise->l_name}}
                        </option>
                    @endforeach
                    </select>
                    @if ($errors->has('franchise_id'))
                        <div class="alert alert-danger">
                            @foreach ($errors->get('franchise_id') as $message)
                                {{ $message }}<br>
                            @endforeach
                        </div>
                    @endif
                </label>

                <label class="half-field">
                    <span>Type Of Work Required</span>
                    <select name="work_type_id" id="work_type">
                        @foreach($work_types as $work_type)
                            <option value="{{$work_type->id}}">
                                {{$work_type->work_type}}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('work_type_id'))
                        <div class="alert alert-danger">
                            @foreach ($errors->get('work_type_id') as $message)
                                {{ $message }}<br>
                            @endforeach
                        </div>
                    @endif
                </label>

                <label class="half-field">
                    <span>Service Date</span>
                    <input type="datetime" id="date" name="suggested_date" placeholder="date">
                    @if ($errors->has('suggested_date'))
                        <div class="alert alert-danger">
                            @foreach ($errors->get('suggested_date') as $message)
                                {{ $message }}<br>
                            @endforeach
                        </div>
                    @endif
                </label>
                <label class="submit">
                    <input type="submit" class="btn btn btn-primary" name="submit" value="Send">
                </label>
            </form>
        </div>
    </section>
    <script>
//        $(function() {
//            $("#date").datetimepicker({
////                dateFormat: 'yy-mm-dd'
//            });
//        });

        $('#date').datetimepicker({
            dateFormat:'yy-m-d'
        });

        $("#vehicle_type").select2({

            allowClear: true,
            placeholder: "Select Vehicle Type"

        });
        $("#franchise").select2({

            allowClear: true,
            placeholder: "Select Franchise"

        });
        $("#work_type").select2({

            allowClear: true,
            placeholder: "Select Work Type"

        });

    </script>
@endsection
