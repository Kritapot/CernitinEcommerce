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
            @if (Session::has('flash_message_success'))
            <div class="alert alert-error alert-block" id="message-box" style="background-color: #00C851">
                <strong style="color: white">{!! session('flash_message_success') !!}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
        <div class="row">
            <div class="col-sm-6 col-sm-offset-1">
                <div class="login-form"><!--login form-->
                    <h2>ลืมรหัสผ่านเข้าระบบ</h2>
                    <form name="forgot-form-password" id="forgot-form-password" enctype="multipart/form-data" action="{{ url('/forgot-password') }}" method="POST">
                        @csrf
                        <input name="email" type="email" placeholder="กรุณากรอกอีเมล์ของคุณ" required="กรุณากรอก email"/>
                        <button type="submit" class="btn btn-default">ตกลง</button>
                    </form>
                </div><!--/login form-->
            </div>
        </div>
    </div>
</section><!--/form-->

@endsection
