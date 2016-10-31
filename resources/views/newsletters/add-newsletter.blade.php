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
    <section class="add-vehicle">
        @if(\Session::has('success'))
            <h4>
                {{\Session::get('success')}}
            </h4>
        @endif
            <h2 class="main-heading">Add A Newsletter</h2>
            <div class="add-vehicle-widget">
                <form class="add-vehicle-form" method="post" action="{{url('/')}}/newsletter/add" enctype="multipart/form-data">
                    {{csrf_field()}}

                    <label>
                        <span>Newsletter Title</span>
                        <input type="text" name="name" placeholder="Newsletter title" value="{{old('name')}}">
                        @if ($errors->has('name'))
                            <div class="alert alert-danger">
                                @foreach ($errors->get('name') as $message)
                                    {{ $message }}<br>
                                @endforeach
                            </div>
                        @endif
                    </label>


                    <label style="clear: both">
                        <span>Detail</span>
                        <textarea name="detail" placeholder="Detail">{{old('detail')}}</textarea>
                        @if ($errors->has('detail'))
                            <div class="alert alert-danger">
                                @foreach ($errors->get('detail') as $message)
                                    {{ $message }}<br>
                                @endforeach
                            </div>
                        @endif
                    </label>
                    <label style="clear: both">
                        <input type="file" name="image">
                        @if ($errors->has('image'))
                            <div class="alert alert-danger">
                                @foreach ($errors->get('image') as $message)
                                    {{ $message }}<br>
                                @endforeach
                            </div>
                        @endif
                    </label>
                    <label class="submit">
                        <input type="submit" class="btn btn btn-primary" name="submit" value="Submit">
                    </label>
                </form>
            </div>
    </section>
@endsection