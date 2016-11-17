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
        @if($user->isAdmin())
        <div class="vehicles-head">
            <h3>Manuals</h3>
            @if($user->can('add','manuals'))<a href="{{url('/')}}/manual/add" class="btn btn-primary pull-right">Add a Manual</a>@endif
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
                            <td>{{str_limit($manual->description)}}</td>
                            <td><a href="{{url('/')}}/manual/{{$manual->id}}">View</a></td>
                            <td>
                                @if($user->can('edit','manuals', $manual))<a href="{{url('/')}}/manual/update/{{$manual->id}}"><i class="fa fa-edit fa-fw"></i></a>@endif
                                @if($user->can('delete','manuals', $manual))<form method="post" action="{{url('/')}}/manual/delete/{{$manual->id}}">{{csrf_field()}}<button><i class="fa fa-trash fa-fw"></i></button></form>@endif
                            </td>
                            <td></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @else
            <h2 class="main-heading">Manuals</h2>
            <div class="news-listing">
                <ul class="row">
                    @foreach($manuals as $manual)
                        <li class="col-md-4 col-sm-4 col-xm-12">
                            <div class="news-widget">
                                <figure>
                                    @if(count($manual->images->all()))
                                        <img src="{{url('/')}}/{{$manual->images->all()[0]->image}}" alt="">
                                    @endif
                                </figure>
                                <div class="store-content">
                                    <h4>{{$manual->title}}</h4>
                                    <p>{{str_limit($manual->description, 150)}}</p>
                                    <a href="{{url('/')}}/manual/{{$manual->id}}">Read More</a>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </section>
@endsection