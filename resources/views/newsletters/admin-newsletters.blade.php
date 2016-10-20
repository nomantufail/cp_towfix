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
            <h3>Store</h3>
            <a href="{{url('/')}}/newsletter/add" class="btn btn-primary pull-right">Add a Newsletter</a>
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
                        <th>Details</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($newsletters as $newsletter)
                    <tr>
                        <td>{{$newsletter->name}}</td>
                        <td>{{$newsletter->detail}}</td>
                        <td><a href="{{url('/')}}/newsletter/{{$newsletter->id}}">View</a></td>
                        <td>
                            <a href="{{url('/')}}/newsletter/edit/{{$newsletter->id}}"><i class="fa fa-edit fa-fw"></i></a>
                            <form method="post" action="{{url('/')}}/newsletter/delete/{{$newsletter->id}}">{{csrf_field()}}<button><i class="fa fa-trash fa-fw"></i></button></form>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection