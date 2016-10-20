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
                        <input type="text" name="name" placeholder="Newsletter title">
                    </label>


                    <label style="clear: both">
                        <span>Detail</span>
                        <textarea name="detail" placeholder="Detail"></textarea>
                    </label>
                    <label style="clear: both">
                        <input type="file" name="image">
                    </label>
                    <label class="submit">
                        <input type="submit" class="btn btn btn-primary" name="submit" value="Submit">
                    </label>
                </form>
            </div>
    </section>
@endsection