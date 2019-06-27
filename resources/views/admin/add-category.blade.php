@extends('layouts.admin-layouts.design')

@section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.html" class="tip-bottom" data-original-title="Go to Home"><i
                    class="icon-home"></i> หน้าหลัก</a> <a href="#">ประเภทสินค้า</a> <a href="#"
                class="current">เพิ่มประเภทสินค้า</a> </div>
        <h1>ประเภทสินค้า</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                        <h5>เพิ่มประเภทสินค้า</h5>
                    </div>

                    <div class="widget-content nopadding">
                        <form class="form-horizontal" method="post" action="{{ url('/admin/add-category/save') }}" name="add-category" id="add-category" novalidate="novalidate">{{ csrf_field() }}
                            <div class="control-group">
                                <label class="control-label">ชื่อประเภท</label>
                                <div class="controls">
                                    <input type="text" name="name" id="name">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">ประเภทย่อย</label>
                                <div class="controls">
                                    <select name="parent_id" style="width: 220px">
                                        <option value="0">--ประเภทหลัก--</option>
                                            @foreach ($levelCategory as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">รายละเอียด</label>
                                <div class="controls">
                                    <textarea name="description" id="description"></textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">URL</label>
                                <div class="controls">
                                    <input type="text" name="url" id="url">
                                </div>
                            </div>
                            <div class="form-actions">
                                <input type="submit" value="บันทึก" class="btn btn-success">
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
