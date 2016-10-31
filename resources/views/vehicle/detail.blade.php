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
    <section class="vehicle-detail">
        <h2 class="main-heading">Vehicle Detail</h2>
        <div class="vehicle-widget">
            <div class="vehicle-edit-btns">
                <a href="add-vehicle.html"><i class="fa fa-edit fa-fw"></i></a>
                <a href="#"><i class="fa fa-trash fa-fw"></i></a>
            </div>
            <ul class="vehicle-info">
                <li>
                    <strong>Make</strong>
                    <span>Toyota</span>
                </li>
                <li>
                    <strong>Model</strong>
                    <span>Corrola</span>
                </li>
                <li>
                    <strong>Year</strong>
                    <span>2007</span>
                </li>
                <li>
                    <strong>Vehicle Type</strong>
                    <span>Trailer</span>
                </li>
                <li>
                    <strong>Next Service</strong>
                    <span>Dec/09/16</span>
                </li>
                <li>
                    <strong>Registration Number</strong>
                    <span>12453</span>
                </li>
                <li>
                    <strong>Registration</strong>
                    <span>EFD65F</span>
                </li>
                <li>
                    <strong>Registration Expiry</strong>
                    <span>Dec/12/16</span>
                </li>
                <li>
                    <strong>Details</strong>
                    <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old</p>
                </li>
            </ul>
            <div class="vehicle-history">
                <h4>Vehicle History</h4>
                <table class="customer-table" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Vehicle Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($services as $request)
                    <tr>
                        <td>{{$request->created_at->toFormattedDateString()}}</td>
                        <td>
                            @if($request->form == null)
                                @if($request->franchise_id == $user->id)
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#request_form_model_{{$request->id}}">Add Form</button>
                                @else
                                    <span style="color:red">pending</span>
                                @endif
                            @else
                                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#request_form_model_{{$request->id}}">View</button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    @foreach($services as $request)
        <div id="request_form_model_{{$request->id}}" class="modal fade" role="dialog">
            <div class="modal-dialog vehicle-detail-popup">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="vehicles-head">
                        <h3>Vehicle Service Form</h3>
                    </div>
                    <form class="add-vehicle-form" method="post" action="@if($request->franchise_id == $user->id){{url('/vehicle')}}/{{$request->vehicle->id}}/add_document @else # @endif">
                        {{csrf_field()}}
                        <input type="hidden" name="cust_vehicle_srv_reqs_id" value="{{$request->id}}">
                        <div class="add-vehicle-widget">
                            <label>
                                <span>Name</span>
                                <input type="text" name="document[simpleInformation][name]" placeholder="Name">
                            </label>

                            <label class="half-field">
                                <span>Make/Year</span>
                                <input type="text" class="datetimepicker" name="document[simpleInformation][make_year]" placeholder="Make/Year">
                            </label>

                            <label class="half-field">
                                <span>Tandem/Single</span>
                                <input type="text" name="document[simpleInformation][tendem_single]" placeholder="Tandem/Single">
                            </label>

                            <label class="half-field">
                                <span>Rego</span>
                                <input type="tel" name="document[simpleInformation][rego]" placeholder="Rego">
                            </label>
                            <label class="half-field">
                                <span>Date</span>
                                <input type="text" class="datetimepicker" name="Date" placeholder="Date" name="document[simpleInformation][date]">
                            </label>
                        </div>
                        <div class="vehicles-service-list">
                            <table class="customer-table" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Poor</th>
                                    <th>Fair</th>
                                    <th>Good</th>
                                    <th>Comments</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Lh indicator</td>
                                    <td><input type="radio" name="document[condition][lh_indicator]"> </td>
                                    <td><input type="radio" name="document[condition][lh_indicator]"> </td>
                                    <td><input type="radio" name="document[condition][lh_indicator]"> </td>
                                    <td>Check operation</td>
                                </tr>

                                <tr>
                                    <td>Rh indicator</td>
                                    <td><input type="radio" name="document[condition][rh_indicator]"> </td>
                                    <td><input type="radio" name="document[condition][rh_indicator]"> </td>
                                    <td><input type="radio" name="document[condition][rh_indicator]"> </td>
                                    <td>Check operation</td>
                                </tr>

                                <tr>
                                    <td>No plate light</td>
                                    <td><input type="radio" name="document[condition][no_plate_light]"> </td>
                                    <td><input type="radio" name="document[condition][no_plate_light]"> </td>
                                    <td><input type="radio" name="document[condition][no_plate_light]"> </td>
                                    <td>Check operation</td>
                                </tr>

                                <tr>
                                    <td>Water tank mounts</td>
                                    <td><input type="radio" name="document[condition][water_tank_mounts]"> </td>
                                    <td><input type="radio" name="document[condition][water_tank_mounts]"> </td>
                                    <td><input type="radio" name="document[condition][water_tank_mounts]"> </td>
                                    <td>Check operation</td>
                                </tr>

                                <tr>
                                    <td>Hand brake </td>
                                    <td><input type="radio" name="document[condition][hand_brake]"> </td>
                                    <td><input type="radio" name="document[condition][hand_brake]"> </td>
                                    <td><input type="radio" name="document[condition][hand_brake]"> </td>
                                    <td>Check operation</td>
                                </tr>

                                <tr>
                                    <td>Trailer plug</td>
                                    <td><input type="radio" name="document[condition][trailer_plug]"> </td>
                                    <td><input type="radio" name="document[condition][trailer_plug]"> </td>
                                    <td><input type="radio" name="document[condition][trailer_plug]"> </td>
                                    <td>Check operation</td>
                                </tr>

                                <tr>
                                    <td>Wiring loom</td>
                                    <td><input type="radio" name="document[condition][wiring_loom]"> </td>
                                    <td><input type="radio" name="document[condition][wiring_loom]"> </td>
                                    <td><input type="radio" name="document[condition][wiring_loom]"> </td>
                                    <td>Check operation</td>
                                </tr>

                                <tr>
                                    <td>Springs/hangers</td>
                                    <td><input type="radio" name="document[condition][springs_hangers]"> </td>
                                    <td><input type="radio" name="document[condition][springs_hangers]"> </td>
                                    <td><input type="radio" name="document[condition][springs_hangers]"> </td>
                                    <td>Check operation</td>
                                </tr>

                                <tr>
                                    <td>U-bolts</td>
                                    <td><input type="radio" name="document[condition][u_bolts]"> </td>
                                    <td><input type="radio" name="document[condition][u_bolts]"> </td>
                                    <td><input type="radio" name="document[condition][u_bolts]"> </td>
                                    <td>Check operation</td>
                                </tr>

                                <tr>
                                    <td>A-frame</td>
                                    <td><input type="radio" name="document[condition][a_frame]"> </td>
                                    <td><input type="radio" name="document[condition][a_frame]"> </td>
                                    <td><input type="radio" name="document[condition][a_frame]"> </td>
                                    <td>Check operation</td>
                                </tr>

                                <tr>
                                    <td>Stabiliser Jacks</td>
                                    <td><input type="radio" name="document[condition][stabiliser_jacks]"> </td>
                                    <td><input type="radio" name="document[condition][stabiliser_jacks]"> </td>
                                    <td><input type="radio" name="document[condition][stabiliser_jacks]"> </td>
                                    <td>Check operation</td>
                                </tr>

                                <tr>
                                    <td>Chassis Welds</td>
                                    <td><input type="radio" name="document[condition][chassis_welds]"> </td>
                                    <td><input type="radio" name="document[condition][chassis_welds]"> </td>
                                    <td><input type="radio" name="document[condition][chassis_welds]"> </td>
                                    <td>Check operation</td>
                                </tr>

                                <tr>
                                    <td>Safety chains</td>
                                    <td><input type="radio" name="document[condition][safety_chains]"> </td>
                                    <td><input type="radio" name="document[condition][safety_chains]"> </td>
                                    <td><input type="radio" name="document[condition][safety_chains]"> </td>
                                    <td>Check operation</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="vehicles-service-list">
                            <table class="customer-table" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Wheel cylinders</th>
                                    <th>Wheel bearings</th>
                                    <th>Brake shoes</th>
                                    <th>Brake magnet</th>
                                    <th>Hub wear</th>
                                    <th>Tyre wear</th>
                                    <th>Tyre Psi</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>RHR</td>
                                    <td><input type="text" name="document[detail][rhr][wheel_cylinders]" placeholder="Details"> </td>
                                    <td><input type="text" name="document[detail][rhr][wheel_bearings]" placeholder="Details"> </td>
                                    <td><input type="text" name="document[detail][rhr][break_shoes]" placeholder="Details"> </td>
                                    <td><input type="text" name="document[detail][rhr][brake_magnet]" placeholder="Details"> </td>
                                    <td><input type="text" name="document[detail][rhr][hub_wear]" placeholder="Details"> </td>
                                    <td><input type="text" name="document[detail][rhr][tyre_wear]" placeholder="Details"> </td>
                                    <td><input type="text" name="document[detail][rhr][tyre_psi]" placeholder="Details"> </td>
                                </tr>

                                <tr>
                                    <td>RHF</td>
                                    <td><input type="text" name="document[detail][rhf][wheel_cylinders]" placeholder="Details"> </td>
                                    <td><input type="text" name="document[detail][rhf][wheel_bearings]" placeholder="Details"> </td>
                                    <td><input type="text" name="document[detail][rhf][break_shoes]" placeholder="Details"> </td>
                                    <td><input type="text" name="document[detail][rhf][brake_magnet]" placeholder="Details"> </td>
                                    <td><input type="text" name="document[detail][rhf][hub_wear]" placeholder="Details"> </td>
                                    <td><input type="text" name="document[detail][rhf][tyre_wear]" placeholder="Details"> </td>
                                    <td><input type="text" name="document[detail][rhf][tyre_psi]" placeholder="Details"> </td>
                                </tr>

                                <tr>
                                    <td>LHR</td>
                                    <td><input type="text" name="document[detail][lhr][wheel_cylinders]" placeholder="Details"> </td>
                                    <td><input type="text" name="document[detail][lhr][wheel_bearings]" placeholder="Details"> </td>
                                    <td><input type="text" name="document[detail][lhr][break_shoes]" placeholder="Details"> </td>
                                    <td><input type="text" name="document[detail][lhr][brake_magnet]" placeholder="Details"> </td>
                                    <td><input type="text" name="document[detail][lhr][hub_wear]" placeholder="Details"> </td>
                                    <td><input type="text" name="document[detail][lhr][tyre_wear]" placeholder="Details"> </td>
                                    <td><input type="text" name="document[detail][lhr][tyre_psi]" placeholder="Details"> </td>
                                </tr>

                                <tr>
                                    <td>LHF</td>
                                    <td><input type="text" name="document[detail][lhf][wheel_cylinders]" placeholder="Details"> </td>
                                    <td><input type="text" name="document[detail][lhf][wheel_bearings]" placeholder="Details"> </td>
                                    <td><input type="text" name="document[detail][lhf][break_shoes]" placeholder="Details"> </td>
                                    <td><input type="text" name="document[detail][lhf][brake_magnet]" placeholder="Details"> </td>
                                    <td><input type="text" name="document[detail][lhf][hub_wear]" placeholder="Details"> </td>
                                    <td><input type="text" name="document[detail][lhf][tyre_wear]" placeholder="Details"> </td>
                                    <td><input type="text" name="document[detail][lhf][tyre_psi]" placeholder="Details"> </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="vehicles-service-detail">
                            <label>
                                <span>Other observations to be advised to owner:</span>
                                <textarea placeholder="Observations" name="document[observations]"></textarea>
                            </label>
                            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    @endforeach

@endsection