@extends('layouts.admin-layouts.design')

@section('content')
<div id="content">
        <div id="content-header">
          <div id="breadcrumb"> <a href="index.html" class="tip-bottom" data-original-title="Go to Home"><i class="icon-home"></i> Home</a> <a href="#">Form elements</a> <a href="#" class="current">Validation</a> </div>
          <h1>ตั้งค่าผู้ใช้งานระบบ</h1>
        </div>
        <div class="container-fluid"><hr>
          <div class="row-fluid">
            <div class="span12">
              <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                  <h5>เปลี่ยนรหัสผ่าน</h5>
                </div>

                <div class="widget-content nopadding">
                    @if (Session::has('flash_message_errors'))
                        <div class="alert alert-error alert-block">
                            <strong>{!! session('flash_message_errors') !!}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                    @endif
                    @if (Session::has('flash_message_success'))
                        <div class="alert alert-success alert-block">
                            <strong>{!! session('flash_message_success') !!}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <form class="form-horizontal" method="post" action="{{ url('/admin/update-password') }}" name="password_validate" id="password_validate" novalidate="novalidate">
                        {{ csrf_field() }}
                        <div class="control-group">
                        <label class="control-label">Current password</label>
                        <div class="controls">
                            <input type="password" name="current_pwd" id="current_pwd">
                            <span id="password-check"></span>
                        </div>
                        </div>
                        <div class="control-group">
                        <label class="control-label">New password</label>
                        <div class="controls">
                            <input type="password" name="new_pwd" id="new_pwd">
                        </div>
                        </div>
                        <div class="control-group">
                        <label class="control-label">Confirm password</label>
                        <div class="controls">
                            <input type="password" name="confirm_pwd" id="confirm_pwd">
                        </div>
                        </div>
                        <div class="form-actions">
                        <input type="submit" value="ตกลง" class="btn btn-success">
                        </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection
