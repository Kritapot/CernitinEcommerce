@extends('layouts.fontend-design')
@section('content')
<div class="container text-center">
    <div class="logo-404">
        <a href="index.html"><img src="images/home/logo.png" alt="" /></a>
    </div>
    <div class="content-404">
        <h1><b>!</b> ไม่พบรายการที่ท่านค้นหา</h1>
        <p>Uh... So it looks like you brock something. The page you are looking for has up and Vanished.</p>
        <h2><a href="{{ url('/') }}">กลับไปหน้าหลัก</a></h2>
    </div><br><br>
</div>
@endsection
