@extends('layouts.admin-layouts.design')

@section('content')
    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="index.html" class="tip-bottom" data-original-title="Go to Home"><i
                        class="icon-home"></i> หน้าหลัก</a> <a href="#">banner</a> <a href="#"
                    class="current">banner</a> </div>
            <h1>แก้ไข Banner</h1>
        </div>
        @if (Session::has('flash_message_errors'))
        <div class="alert alert-error alert-block" id="message-box">
            <strong>{!! session('flash_message_errors') !!}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        @if (Session::has('flash_message_success'))
        <div class="alert alert-success alert-block" id="message-box">
            <strong>{!! session('flash_message_success') !!}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <div class="container-fluid">
            <hr>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                            <h5>แก้ไข Banner</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <form enctype="multipart/form-data" class="form-horizontal" method="POST" action="{{ url('/admin/edit-banner/'.$banner['id']) }}" name="add-banner" id="add-banner" novalidate="novalidate">
                                @csrf
                                <div class="control-group">
                                    <label class="control-label">รูปภาพ Banner</label>
                                    <div class="controls">
                                        <input type="file" name="image">
                                        <input type="hidden" name="current_image" value="{{$banner['image']}}"><br>
                                        @if (!empty($banner['image']))
                                        <img style="width: 600px; height: 250px;" src="{{ asset('images/fontend_images/banner/'.$banner['image']) }}">
                                        @endif
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">หัวข้อ</label>
                                    <div class="controls">
                                        <input type="text" name="title" value="{{ $banner['title'] }}">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Link</label>
                                    <div class="controls">
                                        <input type="text" name="link" value="{{ $banner['link'] }}">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">เปิด-ปิดการแสดง Banner</label>
                                    <div class="controls">
                                        <input {{ $banner['status'] == 1 ? 'checked' : '' }} type="checkbox" name="status" id="status" value="1">
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <input type="submit" value="บันทึก" class="btn btn-success">
                                    <a href="{{ url('/admin/list-banner') }}" class="btn btn-info">กลับไป</a>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
