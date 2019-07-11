@extends('layouts.fontend-design')

@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">thank</li>
            </ol>
        </div>
    </div>
</section>
<!--/#cart_items-->
<section id="do_action">
    <div class="container">
        <div class="heading text-center">
            <h3>Your CDO order has been place</h3>
            <p>Your order number is 00000{{ Session::get('order_id') }} and total patable about is THB  {{ Session::get('grand_total') }}</p>
        </div>
    </div>
</section>
<!--/#do_action-->
@endsection

@php
    Session::forget('order_id');
    Session::forget('grand_total');
@endphp
