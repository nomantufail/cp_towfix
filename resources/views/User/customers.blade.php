<?php
/**
 * Created by PhpStorm.
 * User: nomantufail
 * Date: 10/20/2016
 * Time: 10:07 AM
 */

?>

@extends('app')
@section('page')
    <section class="vehicles-list">
        <div class="vehicles-head">
            <h3>Customers</h3>
        </div>
        <div class="vehicles-list-content">
            <div class="vehicles-table">
                <table id="tableStyle" class="display" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Customer Name</th>
                        <th>Membership Number</th>
                        <th>Email Address</th>
                        <th>Contact Number</th>
                        <th>Details</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($customers as $customer)
                        <tr>
                            <td>{{$customer->f_name}} {{$customer->l_name}}</td>
                            <td>15487</td>
                            <td>{{$customer->email}}</td>
                            <td>{{$customer->phone_number}}</td>


                            <td><a href="#">View</a></td>
                            <td>
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
