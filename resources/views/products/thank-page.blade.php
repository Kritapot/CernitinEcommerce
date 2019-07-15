@extends('layouts.fontend-design')

@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">ขอบคุณ</li>
            </ol>
        </div>
    </div>
</section>
<!--/#cart_items-->
<section id="do_action">
    <div class="container">
        <div class="heading text-center">
            <h2>การสั่งซื้อของคุณสำเร็จแล้ว เราจะตรวจสอบและจัดส่งสินค้าให้โดยเร็วที่สุด</h2>
            <p style="font-size: 18px;">
                หมายเลขการสั่งซื้อสินค้าของคุณคือ
                <span style="color: green">{{ Session::get('order_id') }}</span><br>
                ยอดรวมของการสั่งซื้อคือ
                <span style="color: green">{{ Session::get('grand_total') }}</span></p>
                <a href="{{ url('/') }}" class="btn btn-success">กลับไปหน้าหลัก</a>
        </div>
    </div>
</section>
<!--/#do_action-->
@endsection

@php
    Session::forget('order_id');
    Session::forget('grand_total');
@endphp
