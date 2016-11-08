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
            <h3>Manuals</h3>
            <a href="{{url('/')}}/manual/add" class="btn btn-primary pull-right">Add a Manual</a>
        </div>
        <div class="vehicles-list-content">
            <div class="vehicles-table">
                @if(\Session::has('success'))
                    <h4>
                        {{\Session::get('success')}}
                    </h4>
                @endif
                <table id="tableStyle" class="display" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Detail</th>
                        <th>Actions</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($manuals as $manual)
                        <tr>
                            <td>{{$manual->title}}</td>
                            <td>{{$manual->description}}</td>
                            <td>View</td>
                            <td>
                                <a href="{{url('/')}}/manual/update/{{$manual->id}}"><i class="fa fa-edit fa-fw"></i></a>
                                <form method="post" action="{{url('/')}}/manual/delete/{{$manual->id}}">{{csrf_field()}}<button><i class="fa fa-trash fa-fw"></i></button></form>
                            </td>
                            <td></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection