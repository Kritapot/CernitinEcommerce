@extends('layouts.fontend-design')

@section('content')
<section id="form" style="margin-top: 20px;"><!--form-->
    <div class="container">
            @if (Session::has('flash_message_success'))
            <div class="alert alert-error alert-block" id="message-box" style="background-color: #00C851">
                <strong style="color: white">{!! session('flash_message_success') !!}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
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
                    <form enctype="multipart/form-data" action="{{ url('account') }}" method="POST" name="accountForm" id="accountForm">
                        @csrf
                        <input value="{{ $user_detail['name'] }}" name="name" type="text" placeholder="Name" />
                        <input value="{{ $user_detail['address'] }}" name="address" type="text" placeholder="Address" />
                        <input value="{{ $user_detail['city'] }}" name="city" type="text" placeholder="City" />
                        <input value="{{ $user_detail['state'] }}" name="state" type="text" placeholder="State" />
                        <select name="country" id="country">
                            <option value="">select country</option>
                            @foreach ($country as $key => $item)
                                <option {{ $user_detail['country'] == $item['country_name'] ? 'selected' : '' }} value="{{ $item['country_name'] }}">{{ $item['country_name'] }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" value="{{ $user_detail['id'] }}" name="id">
                        <input value="{{ $user_detail['pincode'] }}" style="margin-top: 10px" name="pincode" type="text" placeholder="Pincode" />
                        <input value="{{ $user_detail['mobile'] }}" name="mobile" type="text" placeholder="Mobile" />
                        <button type="submit" class="btn btn-default">บันทึก</button>
                    </form>
                </div><!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">หรือ</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form"><!--sign up form-->
                    <h2>เปลี่ยนรหัสผู้ใช้งาน</h2>
                    <form enctype="multipart/form-data" action="{{ url('/update-user-pwd') }}" method="POST" name="passwordForm" id="passwordForm">
                        @csrf
                        <input type="password" name="current_pwd" id="current-pwd" placeholder="รหัสผ่าน"><span id="check-current-pwd"></span>
                        <input type="password" name="new_pwd" id="new-pwd" placeholder="รหัสผ่านใหม่">
                        <input type="password" name="confirm_pwd" id="confrim-pwd" placeholder="ยืนยันรหัสผ่านใหม่">
                        <button type="submit" class="btn btn-default">ยืนยันการเปลี่ยน</button>
                    </form>
                </div><!--/sign up form-->
            </div>
        </div>
    </div>
</section><!--/form-->

@endsection
