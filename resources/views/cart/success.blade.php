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
    <section class="success-payment">
        <h2 style="color:green">
            Transaction of amount {{$data['amount']}} Successful
        </h2>
    </section>
@endsection