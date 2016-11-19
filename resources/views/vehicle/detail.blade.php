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
        @if(\Session::has('success'))
            <h4 class="alert alert-success fade in">
                {{\Session::get('success')}}
            </h4>
        @endif
        <h2 class="main-heading">Vehicle Detail</h2>
        <div class="vehicle-widget">
            <div class="vehicle-edit-btns">
                @if($user->can('edit','vehicles',$vehicle))<a href="{{url('/')}}/vehicle/update/{{$vehicle->id}}"><i class="fa fa-edit fa-fw"></i></a>@endif
            </div>
            <ul class="vehicle-info">
                <li>
                    <strong>Make</strong>
                    <span>{{$vehicle->make}}</span>
                </li>
                <li>
                    <strong>Model</strong>
                    <span>{{$vehicle->model}}</span>
                </li>
                <li>
                    <strong>Year</strong>
                    <span>{{$vehicle->year}}</span>
                </li>
                <li>
                    <strong>Vehicle Type</strong>
                    <span>{{$vehicle->type->vehicle_type}}</span>
                </li>
                <li>
                    <strong>Next Service</strong>
                    <span>{!! \App\Libs\Helpers\Helper::towfixDateFormat($vehicle->next_service) !!}</span>

                </li>
                <li>
                    <strong>Registration Number</strong>
                    <span>{{$vehicle->registration_number}}</span>
                </li>
                <li>
                    <strong>Registration Expiry</strong>
                    <span>{!! \App\Libs\Helpers\Helper::towfixDateFormat($vehicle->registration_expiry) !!}</span>
                </li>
                <li>
                    <strong>Details</strong>
                    <p>{{$vehicle->details}}</p>
                </li>
            </ul>
            <div class="vehicle-history">
                <h4>Vehicle Service History</h4>
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
                        <td>{!! \App\Libs\Helpers\Helper::towfixDateFormat($request->created_at) !!}</td>
                        <td>
                            @if($request->form == null)
                                @if($request->franchise_id == $user->id && $request->isAccepted())
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
        <?php
            $document = ($request->document != null)?json_decode($request->document->document):null;
        ?>
        <div id="request_form_model_{{$request->id}}" class="modal fade" role="dialog">
            <div class="modal-dialog vehicle-detail-popup">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="vehicles-head">
                        <h3>Vehicle Service Form</h3>
                    </div>
                    <form class="add-vehicle-form" method="post" @if($document == null && $request->franchise_id == $user->id)action="{{url('/vehicle')}}/{{$request->vehicle->id}}/add_document" @elseif($document != null && !$user->isCustomer()) action="{{url('/vehicle')}}/{{$request->vehicle->id}}/update_document" @else onsubmit="return false" @endif >
                        {{csrf_field()}}
                        <input type="hidden" name="cust_vehicle_srv_reqs_id" value="{{$request->id}}">
                        <div class="add-vehicle-widget">
                            <label>
                                <span>Name</span>
                                <input @if($document != null && $user->isCustomer()) disabled @endif type="text" name="document[simpleInformation][name]" placeholder="Name" value="@if($document != null) {{$document->simpleInformation->name}} @endif">
                            </label>

                            <label class="half-field">
                                <span>Make/Year</span>
                                <input @if($document != null && $user->isCustomer()) disabled @endif type="text" id="datetimepicker" name="document[simpleInformation][make_year]" placeholder="Make/Year" value="@if($document != null) {{$document->simpleInformation->make_year}} @endif">
                            </label>

                            <label class="half-field">
                                <span>Number Of Axles</span>
                                <input @if($document != null && $user->isCustomer()) disabled @endif type="number" name="document[simpleInformation][tendem_single]" placeholder="Number Of Axles" value="@if($document != null) {{$document->simpleInformation->tendem_single}} @endif">
                            </label>

                            <label class="half-field">
                                <span>Rego</span>
                                <input @if($document != null && $user->isCustomer()) disabled @endif type="tel" name="document[simpleInformation][rego]" placeholder="Rego" value="@if($document != null) {{$document->simpleInformation->rego}} @endif">
                            </label>
                            <label class="half-field">
                                <span>Date</span>
                                <input @if($document != null && $user->isCustomer()) disabled @endif type="text" class="datetimepicker" placeholder="Date" name="document[simpleInformation][date]" value="@if($document != null){{$document->simpleInformation->date}} @endif">
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
                                    @if(!$user->isCustomer())
                                    <td><input type="radio" name="document[condition][lh_indicator]" value="1" @if($document != null && isset($document->condition->lh_indicator) && $document->condition->lh_indicator == "1") checked="checked" @endif > </td>
                                    <td><input type="radio" name="document[condition][lh_indicator]" value="2" @if($document != null && isset($document->condition->lh_indicator) && $document->condition->lh_indicator == "2") checked="checked" @endif > </td>
                                    <td><input type="radio" name="document[condition][lh_indicator]" value="3" @if($document != null && isset($document->condition->lh_indicator) && $document->condition->lh_indicator == "3") checked="checked" @endif > </td>
                                    @else
                                        <td>
                                            @if( isset($document->condition->lh_indicator) && $document->condition->lh_indicator == "1") <img src="{{url('/')}}/images/tick.png"> @endif
                                        </td>
                                        <td>
                                            @if( isset($document->condition->lh_indicator) && $document->condition->lh_indicator == "2") <img src="{{url('/')}}/images/tick.png"> @endif
                                        </td>
                                        <td>
                                            @if( isset($document->condition->lh_indicator) && $document->condition->lh_indicator == "3") <img src="{{url('/')}}/images/tick.png"> @endif
                                        </td>
                                    @endif
                                        <td><input @if($document != null && $user->isCustomer()) disabled @endif type="text" name="document[comment][lh_indicator]" value="@if($document != null) {{$document->comment->lh_indicator}} @endif" > </td>
                                </tr>

                                <tr>
                                    <td>Rh indicator</td>
                                    @if(!$user->isCustomer())
                                    <td><input type="radio" name="document[condition][rh_indicator]" value="1" @if($document != null && isset($document->condition->rh_indicator) && $document->condition->rh_indicator == "1") checked="checked" @endif > </td>
                                    <td><input type="radio" name="document[condition][rh_indicator]" value="2" @if($document != null && isset($document->condition->rh_indicator) && $document->condition->rh_indicator == "2") checked="checked" @endif > </td>
                                    <td><input type="radio" name="document[condition][rh_indicator]" value="3" @if($document != null && isset($document->condition->rh_indicator) && $document->condition->rh_indicator == "3") checked="checked" @endif > </td>
                                    @else
                                        <td>
                                            @if( isset($document->condition->rh_indicator) && $document->condition->rh_indicator == "1") <img src="{{url('/')}}/images/tick.png"> @endif
                                        </td>
                                        <td>
                                            @if( isset($document->condition->rh_indicator) && $document->condition->rh_indicator == "2") <img src="{{url('/')}}/images/tick.png"> @endif
                                        </td>
                                        <td>
                                            @if( isset($document->condition->rh_indicator) && $document->condition->rh_indicator == "3") <img src="{{url('/')}}/images/tick.png"> @endif
                                        </td>
                                    @endif
                                        <td><input @if($document != null && $user->isCustomer()) disabled @endif type="text" name="document[comment][rh_indicator]" value="@if($document != null) {{$document->comment->rh_indicator}} @endif" > </td>
                                </tr>

                                <tr>
                                    <td>No plate light</td>
                                    @if(!$user->isCustomer())
                                    <td><input type="radio" name="document[condition][no_plate_light]" value="1" @if($document != null && isset($document->condition->no_plate_light) && $document->condition->no_plate_light == "1") checked="checked" @endif > </td>
                                    <td><input type="radio" name="document[condition][no_plate_light]" value="2" @if($document != null && isset($document->condition->no_plate_light) && $document->condition->no_plate_light == "2") checked="checked" @endif > </td>
                                    <td><input type="radio" name="document[condition][no_plate_light]" value="3" @if($document != null && isset($document->condition->no_plate_light) && $document->condition->no_plate_light == "3") checked="checked" @endif > </td>
                                    @else
                                        <td>
                                            @if( isset($document->condition->no_plate_light) && $document->condition->no_plate_light == "1") <img src="{{url('/')}}/images/tick.png"> @endif
                                        </td>
                                        <td>
                                            @if( isset($document->condition->no_plate_light) && $document->condition->no_plate_light == "2") <img src="{{url('/')}}/images/tick.png"> @endif
                                        </td>
                                        <td>
                                            @if( isset($document->condition->no_plate_light) && $document->condition->no_plate_light == "3") <img src="{{url('/')}}/images/tick.png"> @endif
                                        </td>
                                    @endif
                                        <td><input @if($document != null && $user->isCustomer()) disabled @endif type="text" name="document[comment][no_plate_light]" value="@if($document != null) {{$document->comment->no_plate_light}} @endif" > </td>
                                </tr>

                                <tr>
                                    <td>Water tank mounts</td>
                                    @if(!$user->isCustomer())
                                    <td><input type="radio" name="document[condition][water_tank_mounts]" value="1" @if($document != null && isset($document->condition->water_tank_mounts) && $document->condition->water_tank_mounts == "1") checked="checked" @endif > </td>
                                    <td><input type="radio" name="document[condition][water_tank_mounts]" value="2" @if($document != null && isset($document->condition->water_tank_mounts) && $document->condition->water_tank_mounts == "2") checked="checked" @endif > </td>
                                    <td><input type="radio" name="document[condition][water_tank_mounts]" value="3" @if($document != null && isset($document->condition->water_tank_mounts) && $document->condition->water_tank_mounts == "3") checked="checked" @endif > </td>
                                    @else
                                        <td>
                                            @if( isset($document->condition->water_tank_mounts) && $document->condition->water_tank_mounts == "1") <img src="{{url('/')}}/images/tick.png"> @endif
                                        </td>
                                        <td>
                                            @if( isset($document->condition->water_tank_mounts) && $document->condition->water_tank_mounts == "2") <img src="{{url('/')}}/images/tick.png"> @endif
                                        </td>
                                        <td>
                                            @if( isset($document->condition->water_tank_mounts) && $document->condition->water_tank_mounts == "3") <img src="{{url('/')}}/images/tick.png"> @endif
                                        </td>
                                    @endif
                                        <td><input @if($document != null && $user->isCustomer()) disabled @endif type="text" name="document[comment][water_tank_mounts]" value="@if($document != null) {{$document->comment->water_tank_mounts}} @endif" > </td>
                                </tr>

                                <tr>
                                    <td>Hand brake </td>
                                    @if(!$user->isCustomer())
                                    <td><input type="radio" name="document[condition][hand_brake]" value="1" @if($document != null && isset($document->condition->hand_brake) && $document->condition->hand_brake == "1") checked="checked" @endif > </td>
                                    <td><input type="radio" name="document[condition][hand_brake]" value="2" @if($document != null && isset($document->condition->hand_brake) && $document->condition->hand_brake == "2") checked="checked" @endif > </td>
                                    <td><input type="radio" name="document[condition][hand_brake]" value="3" @if($document != null && isset($document->condition->hand_brake) && $document->condition->hand_brake == "3") checked="checked" @endif > </td>
                                    @else
                                        <td>
                                            @if( isset($document->condition->hand_brake) && $document->condition->hand_brake == "1") <img src="{{url('/')}}/images/tick.png"> @endif
                                        </td>
                                        <td>
                                            @if( isset($document->condition->hand_brake) && $document->condition->hand_brake == "2") <img src="{{url('/')}}/images/tick.png"> @endif
                                        </td>
                                        <td>
                                            @if( isset($document->condition->hand_brake) && $document->condition->hand_brake == "3") <img src="{{url('/')}}/images/tick.png"> @endif
                                        </td>
                                    @endif
                                        <td><input @if($document != null && $user->isCustomer()) disabled @endif type="text" name="document[comment][hand_brake]" value="@if($document != null) {{$document->comment->hand_brake}} @endif" > </td>
                                </tr>

                                <tr>
                                    <td>Trailer plug</td>
                                    @if(!$user->isCustomer())
                                    <td><input type="radio" name="document[condition][trailer_plug]" value="1" @if($document != null && isset($document->condition->trailer_plug) && $document->condition->trailer_plug == "1") checked="checked" @endif > </td>
                                    <td><input type="radio" name="document[condition][trailer_plug]" value="2" @if($document != null && isset($document->condition->trailer_plug) && $document->condition->trailer_plug == "2") checked="checked" @endif > </td>
                                    <td><input type="radio" name="document[condition][trailer_plug]" value="3" @if($document != null && isset($document->condition->trailer_plug) && $document->condition->trailer_plug == "3") checked="checked" @endif > </td>
                                    @else
                                        <td>
                                            @if( isset($document->condition->trailer_plug) && $document->condition->trailer_plug == "1") <img src="{{url('/')}}/images/tick.png"> @endif
                                        </td>
                                        <td>
                                            @if( isset($document->condition->trailer_plug) && $document->condition->trailer_plug == "2") <img src="{{url('/')}}/images/tick.png"> @endif
                                        </td>
                                        <td>
                                            @if( isset($document->condition->trailer_plug) && $document->condition->trailer_plug == "3") <img src="{{url('/')}}/images/tick.png"> @endif
                                        </td>
                                    @endif
                                        <td><input @if($document != null && $user->isCustomer()) disabled @endif type="text" name="document[comment][trailer_plug]" value="@if($document != null) {{$document->comment->trailer_plug}} @endif" > </td>
                                </tr>

                                <tr>
                                    <td>Wiring loom</td>
                                    @if(!$user->isCustomer())
                                    <td><input type="radio" name="document[condition][wiring_loom]" value="1" @if($document != null && isset($document->condition->wiring_loom) && $document->condition->wiring_loom == "1") checked="checked" @endif > </td>
                                    <td><input type="radio" name="document[condition][wiring_loom]" value="2" @if($document != null && isset($document->condition->wiring_loom) && $document->condition->wiring_loom == "2") checked="checked" @endif > </td>
                                    <td><input type="radio" name="document[condition][wiring_loom]" value="3" @if($document != null && isset($document->condition->wiring_loom) && $document->condition->wiring_loom == "3") checked="checked" @endif > </td>
                                    @else
                                        <td>
                                            @if( isset($document->condition->wiring_loom) && $document->condition->wiring_loom == "1") <img src="{{url('/')}}/images/tick.png"> @endif
                                        </td>
                                        <td>
                                            @if( isset($document->condition->wiring_loom) && $document->condition->wiring_loom == "2") <img src="{{url('/')}}/images/tick.png"> @endif
                                        </td>
                                        <td>
                                            @if( isset($document->condition->wiring_loom) && $document->condition->wiring_loom == "3") <img src="{{url('/')}}/images/tick.png"> @endif
                                        </td>
                                    @endif
                                        <td><input @if($document != null && $user->isCustomer()) disabled @endif type="text" name="document[comment][wiring_loom]" value="@if($document != null) {{$document->comment->wiring_loom}} @endif" > </td>
                                </tr>

                                <tr>
                                    <td>Springs/hangers</td>
                                    @if(!$user->isCustomer())
                                    <td><input type="radio" name="document[condition][springs_hangers]" value="1" @if($document != null && isset($document->condition->springs_hangers) && $document->condition->springs_hangers == "1") checked="checked" @endif > </td>
                                    <td><input type="radio" name="document[condition][springs_hangers]" value="2" @if($document != null && isset($document->condition->springs_hangers) && $document->condition->springs_hangers == "2") checked="checked" @endif > </td>
                                    <td><input type="radio" name="document[condition][springs_hangers]" value="3" @if($document != null && isset($document->condition->springs_hangers) && $document->condition->springs_hangers == "3") checked="checked" @endif > </td>
                                    @else
                                        <td>
                                            @if( isset($document->condition->springs_hangers) && $document->condition->springs_hangers == "1") <img src="{{url('/')}}/images/tick.png"> @endif
                                        </td>
                                        <td>
                                            @if( isset($document->condition->springs_hangers) && $document->condition->springs_hangers == "2") <img src="{{url('/')}}/images/tick.png"> @endif
                                        </td>
                                        <td>
                                            @if( isset($document->condition->springs_hangers) && $document->condition->springs_hangers == "3") <img src="{{url('/')}}/images/tick.png"> @endif
                                        </td>
                                    @endif
                                        <td><input @if($document != null && $user->isCustomer()) disabled @endif type="text" name="document[comment][springs_hangers]" value="@if($document != null) {{$document->comment->springs_hangers}} @endif" > </td>
                                </tr>

                                <tr>
                                    <td>U-bolts</td>
                                    @if(!$user->isCustomer())
                                    <td><input type="radio" name="document[condition][u_bolts]" value="1" @if($document != null && isset($document->condition->u_bolts) && $document->condition->u_bolts == "1") checked="checked" @endif > </td>
                                    <td><input type="radio" name="document[condition][u_bolts]" value="2" @if($document != null && isset($document->condition->u_bolts) && $document->condition->u_bolts == "2") checked="checked" @endif > </td>
                                    <td><input type="radio" name="document[condition][u_bolts]" value="3" @if($document != null && isset($document->condition->u_bolts) && $document->condition->u_bolts == "3") checked="checked" @endif > </td>
                                    @else
                                        <td>
                                            @if( isset($document->condition->u_bolts) && $document->condition->u_bolts == "1") <img src="{{url('/')}}/images/tick.png"> @endif
                                        </td>
                                        <td>
                                            @if( isset($document->condition->u_bolts) && $document->condition->u_bolts == "2") <img src="{{url('/')}}/images/tick.png"> @endif
                                        </td>
                                        <td>
                                            @if( isset($document->condition->u_bolts) && $document->condition->u_bolts == "3") <img src="{{url('/')}}/images/tick.png"> @endif
                                        </td>
                                    @endif
                                        <td><input @if($document != null && $user->isCustomer()) disabled @endif type="text" name="document[comment][u_bolts]" value="@if($document != null) {{$document->comment->u_bolts}} @endif" > </td>
                                </tr>

                                <tr>
                                    <td>A-frame</td>
                                    @if(!$user->isCustomer())
                                    <td><input type="radio" name="document[condition][a_frame]" value="1" @if($document != null && isset($document->condition->a_frame) && $document->condition->u_bolts == "1") checked="checked" @endif > </td>
                                    <td><input type="radio" name="document[condition][a_frame]" value="2" @if($document != null && isset($document->condition->a_frame) && $document->condition->u_bolts == "2") checked="checked" @endif > </td>
                                    <td><input type="radio" name="document[condition][a_frame]" value="3" @if($document != null && isset($document->condition->a_frame) && $document->condition->u_bolts == "3") checked="checked" @endif > </td>
                                    @else
                                        <td>
                                            @if( isset($document->condition->a_frame) && $document->condition->u_bolts == "1") <img src="{{url('/')}}/images/tick.png"> @endif
                                        </td>
                                        <td>
                                            @if( isset($document->condition->a_frame) && $document->condition->u_bolts == "2") <img src="{{url('/')}}/images/tick.png"> @endif
                                        </td>
                                        <td>
                                            @if( isset($document->condition->a_frame) && $document->condition->u_bolts == "3") <img src="{{url('/')}}/images/tick.png"> @endif
                                        </td>
                                    @endif
                                        <td><input @if($document != null && $user->isCustomer()) disabled @endif type="text" name="document[comment][a_frame]" value="@if($document != null) {{$document->comment->a_frame}} @endif" > </td>
                                </tr>

                                <tr>
                                    <td>Stabiliser Jacks</td>
                                    @if(!$user->isCustomer())
                                    <td><input type="radio" name="document[condition][stabiliser_jacks]" value="1" @if($document != null && isset($document->condition->stabiliser_jacks) && $document->condition->stabiliser_jacks == "1") checked="checked" @endif > </td>
                                    <td><input type="radio" name="document[condition][stabiliser_jacks]" value="2" @if($document != null && isset($document->condition->stabiliser_jacks) && $document->condition->stabiliser_jacks == "2") checked="checked" @endif > </td>
                                    <td><input type="radio" name="document[condition][stabiliser_jacks]" value="3" @if($document != null && isset($document->condition->stabiliser_jacks) && $document->condition->stabiliser_jacks == "3") checked="checked" @endif > </td>
                                    @else
                                        <td>
                                            @if( isset($document->condition->stabiliser_jacks) && $document->condition->stabiliser_jacks == "1") <img src="{{url('/')}}/images/tick.png"> @endif
                                        </td>
                                        <td>
                                            @if( isset($document->condition->stabiliser_jacks) && $document->condition->stabiliser_jacks == "2") <img src="{{url('/')}}/images/tick.png"> @endif
                                        </td>
                                        <td>
                                            @if( isset($document->condition->stabiliser_jacks) && $document->condition->stabiliser_jacks == "3") <img src="{{url('/')}}/images/tick.png"> @endif
                                        </td>
                                    @endif
                                        <td><input @if($document != null && $user->isCustomer()) disabled @endif type="text" name="document[comment][stabiliser_jacks]" value="@if($document != null) {{$document->comment->stabiliser_jacks}} @endif" > </td>
                                </tr>

                                <tr>
                                    <td>Chassis Welds</td>
                                    @if(!$user->isCustomer())
                                    <td><input type="radio" name="document[condition][chassis_welds]" value="1" @if($document != null && isset($document->condition->chassis_welds) && $document->condition->chassis_welds == "1") checked="checked" @endif > </td>
                                    <td><input type="radio" name="document[condition][chassis_welds]" value="2" @if($document != null && isset($document->condition->chassis_welds) && $document->condition->chassis_welds == "2") checked="checked" @endif > </td>
                                    <td><input type="radio" name="document[condition][chassis_welds]" value="3" @if($document != null && isset($document->condition->chassis_welds) && $document->condition->chassis_welds == "3") checked="checked" @endif > </td>
                                    @else
                                        <td>
                                            @if( isset($document->condition->chassis_welds) && $document->condition->chassis_welds == "1") <img src="{{url('/')}}/images/tick.png"> @endif
                                        </td>
                                        <td>
                                            @if( isset($document->condition->chassis_welds) && $document->condition->chassis_welds == "2") <img src="{{url('/')}}/images/tick.png"> @endif
                                        </td>
                                        <td>
                                            @if( isset($document->condition->chassis_welds) && $document->condition->chassis_welds == "3") <img src="{{url('/')}}/images/tick.png"> @endif
                                        </td>
                                    @endif
                                        <td><input @if($document != null && $user->isCustomer()) disabled @endif type="text" name="document[comment][chassis_welds]" value="@if($document != null) {{$document->comment->chassis_welds}} @endif"> </td>
                                </tr>

                                <tr>
                                    <td>Safety chains</td>
                                    @if(!$user->isCustomer())
                                    <td><input type="radio" name="document[condition][safety_chains]" value="1" @if($document != null && isset($document->condition->safety_chains) && $document->condition->safety_chains == "1") checked="checked" @endif > </td>
                                    <td><input type="radio" name="document[condition][safety_chains]" value="2" @if($document != null && isset($document->condition->safety_chains) && $document->condition->safety_chains == "2") checked="checked" @endif > </td>
                                    <td><input type="radio" name="document[condition][safety_chains]" value="3" @if($document != null && isset($document->condition->safety_chains) && $document->condition->safety_chains == "3") checked="checked" @endif > </td>
                                    @else
                                        <td>
                                            @if( isset($document->condition->safety_chains) && $document->condition->safety_chains == "1") <img src="{{url('/')}}/images/tick.png"> @endif
                                        </td>
                                        <td>
                                            @if( isset($document->condition->safety_chains) && $document->condition->safety_chains == "2") <img src="{{url('/')}}/images/tick.png"> @endif
                                        </td>
                                        <td>
                                            @if( isset($document->condition->safety_chains) && $document->condition->safety_chains == "3") <img src="{{url('/')}}/images/tick.png"> @endif
                                        </td>
                                    @endif
                                        <td><input @if($document != null && $user->isCustomer()) disabled @endif type="text" name="document[comment][safety_chains]" value="@if($document != null) {{$document->comment->safety_chains}} @endif" > </td>
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
                                    <td><input @if($document != null && $user->isCustomer()) disabled @endif type="text" name="document[detail][rhr][wheel_cylinders]" value="@if($document != null) {{$document->detail->rhr->wheel_cylinders}} @endif" placeholder="Details"> </td>
                                    <td><input @if($document != null && $user->isCustomer()) disabled @endif type="text" name="document[detail][rhr][wheel_bearings]" value="@if($document != null) {{$document->detail->rhr->wheel_bearings}} @endif" placeholder="Details"> </td>
                                    <td><input @if($document != null && $user->isCustomer()) disabled @endif type="text" name="document[detail][rhr][break_shoes]" value="@if($document != null) {{$document->detail->rhr->break_shoes}} @endif" placeholder="Details"> </td>
                                    <td><input @if($document != null && $user->isCustomer()) disabled @endif type="text" name="document[detail][rhr][brake_magnet]" value="@if($document != null) {{$document->detail->rhr->brake_magnet}} @endif" placeholder="Details"> </td>
                                    <td><input @if($document != null && $user->isCustomer()) disabled @endif type="text" name="document[detail][rhr][hub_wear]" value="@if($document != null) {{$document->detail->rhr->hub_wear}} @endif" placeholder="Details"> </td>
                                    <td><input @if($document != null && $user->isCustomer()) disabled @endif type="text" name="document[detail][rhr][tyre_wear]" value="@if($document != null) {{$document->detail->rhr->tyre_wear}} @endif" placeholder="Details"> </td>
                                    <td><input @if($document != null && $user->isCustomer()) disabled @endif type="text" name="document[detail][rhr][tyre_psi]" value="@if($document != null) {{$document->detail->rhr->tyre_psi}} @endif" placeholder="Details"> </td>
                                </tr>

                                <tr>
                                    <td>RHF</td>
                                    <td><input @if($document != null && $user->isCustomer()) disabled @endif type="text" name="document[detail][rhf][wheel_cylinders]" value="@if($document != null) {{$document->detail->rhf->wheel_cylinders}} @endif" placeholder="Details"> </td>
                                    <td><input @if($document != null && $user->isCustomer()) disabled @endif type="text" name="document[detail][rhf][wheel_bearings]" value="@if($document != null) {{$document->detail->rhf->wheel_bearings}} @endif" placeholder="Details"> </td>
                                    <td><input @if($document != null && $user->isCustomer()) disabled @endif type="text" name="document[detail][rhf][break_shoes]" value="@if($document != null) {{$document->detail->rhf->break_shoes}} @endif" placeholder="Details"> </td>
                                    <td><input @if($document != null && $user->isCustomer()) disabled @endif type="text" name="document[detail][rhf][brake_magnet]" value="@if($document != null) {{$document->detail->rhf->brake_magnet}} @endif" placeholder="Details"> </td>
                                    <td><input @if($document != null && $user->isCustomer()) disabled @endif type="text" name="document[detail][rhf][hub_wear]" value="@if($document != null) {{$document->detail->rhf->hub_wear}} @endif" placeholder="Details"> </td>
                                    <td><input @if($document != null && $user->isCustomer()) disabled @endif type="text" name="document[detail][rhf][tyre_wear]" value="@if($document != null) {{$document->detail->rhf->tyre_wear}} @endif" placeholder="Details"> </td>
                                    <td><input @if($document != null && $user->isCustomer()) disabled @endif type="text" name="document[detail][rhf][tyre_psi]" value="@if($document != null) {{$document->detail->rhf->tyre_psi}} @endif" placeholder="Details"> </td>
                                </tr>

                                <tr>
                                    <td>LHR</td>
                                    <td><input @if($document != null && $user->isCustomer()) disabled @endif type="text" name="document[detail][lhr][wheel_cylinders]" value="@if($document != null) {{$document->detail->lhr->wheel_cylinders}} @endif" placeholder="Details"> </td>
                                    <td><input @if($document != null && $user->isCustomer()) disabled @endif type="text" name="document[detail][lhr][wheel_bearings]" value="@if($document != null) {{$document->detail->lhr->wheel_bearings}} @endif" placeholder="Details"> </td>
                                    <td><input @if($document != null && $user->isCustomer()) disabled @endif type="text" name="document[detail][lhr][break_shoes]" value="@if($document != null) {{$document->detail->lhr->break_shoes}} @endif" placeholder="Details"> </td>
                                    <td><input @if($document != null && $user->isCustomer()) disabled @endif type="text" name="document[detail][lhr][brake_magnet]" value="@if($document != null) {{$document->detail->lhr->brake_magnet}} @endif" placeholder="Details"> </td>
                                    <td><input @if($document != null && $user->isCustomer()) disabled @endif type="text" name="document[detail][lhr][hub_wear]" value="@if($document != null) {{$document->detail->lhr->hub_wear}} @endif" placeholder="Details"> </td>
                                    <td><input @if($document != null && $user->isCustomer()) disabled @endif type="text" name="document[detail][lhr][tyre_wear]" value="@if($document != null) {{$document->detail->lhr->tyre_wear}} @endif" placeholder="Details"> </td>
                                    <td><input @if($document != null && $user->isCustomer()) disabled @endif type="text" name="document[detail][lhr][tyre_psi]" value="@if($document != null) {{$document->detail->lhr->tyre_psi}} @endif" placeholder="Details"> </td>
                                </tr>

                                <tr>
                                    <td>LHF</td>
                                    <td><input @if($document != null && $user->isCustomer()) disabled @endif type="text" name="document[detail][lhf][wheel_cylinders]" value="@if($document != null) {{$document->detail->lhf->wheel_cylinders}} @endif" placeholder="Details"> </td>
                                    <td><input @if($document != null && $user->isCustomer()) disabled @endif type="text" name="document[detail][lhf][wheel_bearings]" value="@if($document != null) {{$document->detail->lhf->wheel_bearings}} @endif" placeholder="Details"> </td>
                                    <td><input @if($document != null && $user->isCustomer()) disabled @endif type="text" name="document[detail][lhf][break_shoes]" value="@if($document != null) {{$document->detail->lhf->break_shoes}} @endif" placeholder="Details"> </td>
                                    <td><input @if($document != null && $user->isCustomer()) disabled @endif type="text" name="document[detail][lhf][brake_magnet]" value="@if($document != null) {{$document->detail->lhf->brake_magnet}} @endif" placeholder="Details"> </td>
                                    <td><input @if($document != null && $user->isCustomer()) disabled @endif type="text" name="document[detail][lhf][hub_wear]" value="@if($document != null) {{$document->detail->lhf->hub_wear}} @endif" placeholder="Details"> </td>
                                    <td><input @if($document != null && $user->isCustomer()) disabled @endif type="text" name="document[detail][lhf][tyre_wear]" value="@if($document != null) {{$document->detail->lhf->tyre_wear}} @endif" placeholder="Details"> </td>
                                    <td><input @if($document != null && $user->isCustomer()) disabled @endif type="text" name="document[detail][lhf][tyre_psi]" value="@if($document != null) {{$document->detail->lhf->tyre_psi}} @endif" placeholder="Details"> </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="vehicles-service-detail">
                            <label>
                                <span>Other observations to be advised to owner:</span>
                                <textarea @if($document != null && $user->isCustomer()) disabled @endif placeholder="Observations" name="document[observations]"> @if($document != null) {{$document->observations}} @endif </textarea>
                            </label>
                            <label>
                                <span>Next Service Date/Time</span>
                                <input required @if($document != null && $user->isCustomer()) disabled @endif type="text" class="next_service_date_time" name="next_service" placeholder="next service" value="@if($document != null) {{$request->vehicle->next_service}} @endif">

                            </label>
                            @if(($document == null && $request->franchise_id == $user->id) || ($document != null && !$user->isCustomer()))<input type="submit" name="submit" value="Submit" class="btn btn-primary">@endif
                        </div>
                    </form>
                </div>

            </div>
        </div>
    @endforeach

    <script>
        $(document).ready(function () {
            $('.next_service_date_time').datetimepicker({
                dateFormat:'yy-m-d'
            });
        });
    </script>
@endsection