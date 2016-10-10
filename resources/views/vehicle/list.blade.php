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
    <section class="vehicles-list">
        <div class="vehicles-head">
            <h3>Your Vehicles</h3>
            <a href="add-vehicle.html" class="btn btn-primary pull-right">Add a Vehicles</a>
        </div>
        <div class="vehicles-list-content">
            <div class="vehicles-table">
                <table id="tableStyle" class="display" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Make</th>
                        <th>Model</th>
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
                            <td>Toyota</td>
                            <td>Corolla</td>
                            <td>2015</td>
                            <td>{{$vehicle_types[$vehicle->vehicle_type_id]->vehicle_type}}</td>
                            <td>09/28/16</td>
                            <td>125264</td>
                            <td>10/3/16</td>
                            <td><a href="vehicle-detail.html">View</a></td>
                            <td>
                                <a href="add-vehicle.html"><i class="fa fa-edit fa-fw"></i></a>
                                <a href="#"><i class="fa fa-trash fa-fw"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection