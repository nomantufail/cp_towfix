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
    <section class="vehicles-list">
        <div class="vehicles-head">
            @if(\Session::has('success'))
                <h4>
                    {{\Session::get('success')}}
                </h4>
            @endif
            <h3>Franchises</h3>
        </div>
        <div class="vehicles-list-content">
            <div class="vehicles-table">
                <table id="tableStyle" class="display" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Franchise Name</th>
                        <th>Address</th>
                        <th>Area</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($franchises as $franchise)
                        <tr>
                            <td>{{$franchise->f_name}} {{$franchise->l_name}}</td>
                            <td>{{$franchise->address}}</td>
                            <td>{{strtoupper($franchise->info->area)}}</td>
                            <td>{{$franchise->phone_number}}</td>
                            <td>{{$franchise->email}}</td>


                            <td>
                                @if($franchise->info->status == 0)
                                <form method="post" action="{{url('/')}}/franchise/approve/{{$franchise->id}}">{{csrf_field()}}<button><i class="fa fa-check fa-fw"></i></button></form>
                                @endif
                                <a href="{{url('/')}}/franchise/update/{{$franchise->id}}"><i class="fa fa-edit fa-fw"></i></a>

                                <form method="post" action="{{url('/')}}/franchise/delete/{{$franchise->id}}">{{csrf_field()}}<input type="hidden" value="" name="id"><button><i class="fa fa-trash fa-fw"></i></button></form>
                            </td>
                        </tr>

                    </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </section>
@endsection