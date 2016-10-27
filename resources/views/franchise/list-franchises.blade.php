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
            <a href="{{url('/')}}/franchise/add" class="btn btn-primary pull-right">Add a Franchise</a>
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

                        <tr>
                            <td>Toyota</td>
                            <td>Corolla</td>
                            <td>2015</td>
                            <td></td>
                            <td>09/28/16</td>
                            <td>125264</td>
                            <td>10/3/16</td>
                            <td><a href="#">View</a></td>
                            <td>
                                <a href="{{url('/')}}/vehicle/update/"><i class="fa fa-edit fa-fw"></i></a>
                                <form method="post" action="{{url('/')}}/vehicle/delete">{{csrf_field()}}<input type="hidden" value="" name="id"><button><i class="fa fa-trash fa-fw"></i></button></form>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection