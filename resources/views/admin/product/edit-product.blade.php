@extends('layouts.admin-layouts.design')

@section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.html" class="tip-bottom" data-original-title="Go to Home"><i
                    class="icon-home"></i> หน้าหลัก</a> <a href="#">สินค้า</a> <a href="#"
                class="current">แก้ไขสินค้า</a> </div>
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
                        <h5>แก้ไขสินค้า</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ url('/admin/edit-product/'.$product['id']) }}" name="edit-product" id="edit-product" novalidate="novalidate">{{ csrf_field() }}
                            <div class="control-group">
                                <label class="control-label">ประเภทสินค้า</label>
                                <div class="controls">
                                    <select name="category_id" id="category_id" style="width: 220px">
                                            <option selected disabled>-- เลือกประเภทสินค้า --</option>
                                            @foreach ($categories_dropdown as $key => $value)
                                                <option value="{{ $value['id'] }}" @if($product['category']['id'] == $value['id']) selected @endif>{{ $value['name'] }}</option>
                                                @foreach ($value['categories'] as $key => $subValue)
                                                    <option value="{{ $subValue['id'] }}" @if($product['category']['id'] == $subValue['id']) selected @endif>---{{ $subValue['name'] }}---</option>
                                                @endforeach
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">ชื่อสินค้า</label>
                                <div class="controls">
                                    <input type="text" name="name" id="name" value="{{ $product['product_name'] }}">
                                </div>
                            </div>
                            <div class="control-group">
                                    <label class="control-label">รหัสสินค้า</label>
                                    <div class="controls">
                                        <input type="text" name="product_code" id="product_code" value="{{ $product['product_code'] }}">
                                    </div>
                                </div>
                            <div class="control-group">
                                <label class="control-label">สี</label>
                                <div class="controls">
                                    <input type="text" name="product_color" id="product_color" value="{{ $product['product_color'] }}">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">รายละเอียด</label>
                                <div class="controls">
                                    <textarea style="width: 500px; height: 200px" name="description" id="description">{{ $product['description'] }}</textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Material and Care</label>
                                <div class="controls">
                                    <textarea style="width: 500px; height: 200px" name="care" id="care">{{ $product['care'] }}</textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">ราคา</label>
                                <div class="controls">
                                    <input type="text" name="price" id="price" value="{{ $product['price'] }}">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">เปิด-ปิดการแสดงสินค้า</label>
                                <div class="controls">
                                    <input type="checkbox" @if($product['status'] == 1) checked @endif name="status" id="status" value="1">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">รูปภาพ</label>
                                <div class="controls">
                                    <input type="file" name="image" id="image">
                                    <input type="hidden" name="current_image" value="{{$product['image']}}">
                                    @if (!empty($product['image']))
                                        <img style="width: 100px" src="{{ asset('images/backend_images/products/small/'.$product['image']) }}">
                                        | <a id="delete-pic" href="{{ url('/admin/delete-pic-product/'.$product['id']) }}" class="btn btn-danger btn-mini">ลบรูปภาพ</a>
                                    @endif
                                </div>
                            </div>
                            <div class="form-actions">
                                <input type="submit" value="บันทึก" class="btn btn-success">
                                <a href="/admin/list-product" class="btn btn-info">กลับไป</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
