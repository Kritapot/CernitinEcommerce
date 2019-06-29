@extends('layouts.admin-layouts.design')

@section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.html" class="tip-bottom" data-original-title="Go to Home"><i
                    class="icon-home"></i> หน้าหลัก</a> <a href="#">ประเภทสินค้า</a> <a href="#"
                class="current">เพิ่มประเภทสินค้า</a> </div>
        <h1>Product Attributes</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                        <h5>เพิ่ม attributes</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form class="form-horizontal" method="post" action="{{ url('/admin/add-attributes/'.$productAt['id']) }}" name="add-attributes" id="add-attributes" novalidate="novalidate">{{ csrf_field() }}
                            <div class="control-group">
                                <label class="control-label">ชื่อสินค้า</label>
                                <label class="control-label"><strong>{{ $productAt['product_name'] }}</strong></label>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Code</label>
                                <label class="control-label"><strong>{{ $productAt['product_code'] }}</strong></label>
                            </div>
                            <div class="control-group">
                                <label class="control-label">สี</label>
                                <label class="control-label"><strong>{{ $productAt['product_color'] }}</strong></label>
                            </div>
                            <div class="control-group">
                                <label class="control-label"></label>
                                <div class="field_wrapper">
                                        <input type="text" name="sku[]" id="sku" placeholder="หน่วย" style="width: 120px"/>
                                        <input type="text" name="size[]" id="size" placeholder="ขนาด" style="width: 120px"/>
                                        <input type="text" name="price[]" id="price" placeholder="ราคา" style="width: 120px"/>
                                        <input type="text" name="stock[]" id="stock" placeholder="สินค้าใน stock" style="width: 120px"/>
                                        <a href="javascript:void(0);" class="add_button" title="Add field"><i style="font-size: 1.4em" class="icon-chevron-down">เพิ่ม</i></a>
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
