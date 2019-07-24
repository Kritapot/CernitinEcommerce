@extends('layouts.admin-layouts.design')

@section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.html" class="tip-bottom" data-original-title="Go to Home"><i
                    class="icon-home"></i> หน้าหลัก</a> <a href="#">สินค้า</a> <a href="#"
                class="current">เพิ่มสินค้า</a> </div>
        <h1>สินค้า</h1>
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
                        <h5>เพิ่มสินค้า</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form enctype="multipart/form-data" class="form-horizontal" method="POST" action="{{ url('/admin/add-product') }}" name="add-product" id="add-product" novalidate="novalidate">@csrf
                            <div class="control-group">
                                <label class="control-label">ประเภทสินค้า</label>
                                <div class="controls">
                                    <select name="category_id" id="category_id" style="width: 220px">
                                            <option selected disabled>-- เลือกประเภทสินค้า --</option>
                                        @foreach ($categories as $key => $value)
                                            <option value="{{$value['id']}}" style="font-weight: 600">{{ $value['name'] }}</option>
                                            @foreach ($value['categories'] as $key => $subValue)
                                                <option value="{{$subValue['id']}}">--{{ $subValue['name'] }}--</option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">ชื่อสินค้า</label>
                                <div class="controls">
                                    <input type="text" name="name" id="name">
                                </div>
                            </div>
                            <div class="control-group">
                                    <label class="control-label">รหัสสินค้า</label>
                                    <div class="controls">
                                        <input type="text" name="product_code" id="product_code">
                                    </div>
                                </div>
                            <div class="control-group">
                                <label class="control-label">สี</label>
                                <div class="controls">
                                    <input type="text" name="product_color" id="product_color">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">รายละเอียด</label>
                                <div class="controls">
                                    <textarea name="description" id="description"></textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Material and Care</label>
                                <div class="controls">
                                    <textarea name="care" id="care"></textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">ราคา</label>
                                <div class="controls">
                                    <input type="text" name="price" id="price">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">เปิด-ปิดการแสดงสินค้า</label>
                                <div class="controls">
                                    <input type="checkbox" name="status" id="status" value="1">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">รูปภาพ</label>
                                <div class="controls">
                                    <input type="file" name="image" id="image">
                                </div>
                            </div>
                            <div class="form-actions">
                                <input type="submit" value="บันทึก" class="btn btn-success">
                                <a href="{{ url('/admin/list-product') }}" class="btn btn-info">กลับไป</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
