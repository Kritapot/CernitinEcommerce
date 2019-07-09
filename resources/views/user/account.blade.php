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
                    <h2>เปลี่ยนรายละเอียดผู้ใช้งาน</h2>
                </div><!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">หรือ</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form"><!--sign up form-->
                    <h2>เปลี่ยนรหัสผู้ใช้งาน</h2>
                </div><!--/sign up form-->
            </div>
        </div>
    </div>
</section><!--/form-->

@endsection
