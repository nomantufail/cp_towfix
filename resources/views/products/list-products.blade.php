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
            <a href="{{url('/')}}/product/add" class="btn btn-primary pull-right">Add a New Product</a>
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
                        <th>Product Name</th>
                        <th>Serial Number</th>
                        <th>Product Price/Product Ad</th>
                        <th>Details</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td>{{$product->name}}</td>
                        <td>EF457R</td>
                        <td>{{$product->price}}</td>
                        <td><a href="#">View</a></td>
                        <td>
                            <a href={{url('/')}}/product/update/{{$product->id}}><i class="fa fa-edit fa-fw"></i></a>
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