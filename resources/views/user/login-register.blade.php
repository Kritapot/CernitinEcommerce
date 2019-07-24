@extends('layouts.fontend-design')

@section('content')
<section id="form" style="margin-top: 20px;"><!--form-->
    <div class="container">
            @if (Session::has('flash_message_errors'))
            <div class="alert alert-error alert-block" id="message-box" style="background-color: #ff4444">
                <strong style="color: white">{!! session('flash_message_errors') !!}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form"><!--login form-->
                    <h2>เข้าสู่ระบบ</h2>
                    <form name="login-form-user" id="login-form-user" enctype="multipart/form-data" action="{{ url('/user-login') }}" method="POST">
                        @csrf
                        <input name="email" type="email" placeholder="อีเมล์ของคุณ" required="กรุณากรอก email"/>
                        <input name="password" type="password" placeholder="รหัสผ่านของคุณ" required="กรุณากรอก รหัสผ่าน"/>
                        <a href="{{ url('/forgot-password') }}">ลืมระหัสผ่านเข้าระบบ</a>
                        <button type="submit" class="btn btn-default">เข้าสู่ระบบ</button>
                    </form>
                </div><!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">หรือ</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form"><!--sign up form-->
                    <h2>ผู้ใช้ใหม่ลงทะเบียน!</h2>
                    <form name="login-register" id="login-form" enctype="multipart/form-data" action="{{ url('/form-register') }}" method="POST">
                        @csrf
                        <input name="name" type="text" placeholder="Name"/>
                        <input name="email" type="email" placeholder="Email Address"/>
                        <input id="myPassword" name="password" type="password" placeholder="Password"/>
                        <button type="submit" class="btn btn-default">ลงทะเบียน</button>
                    </form>
                </div><!--/sign up form-->
            </div>
        </div>
    </div>
</section><!--/form-->

@endsection
