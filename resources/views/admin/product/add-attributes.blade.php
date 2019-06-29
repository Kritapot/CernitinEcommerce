@extends('layouts.admin-layouts.design')

@section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.html" class="tip-bottom" data-original-title="Go to Home"><i
                    class="icon-home"></i> หน้าหลัก</a> <a href="#">สินค้า</a> <a href="#"
                class="current">คุณลักษณะสินค้า</a> </div>
        <h1>เพิ่มคุณลักษณะให้สินค้า</h1>
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
                        <h5>เพิ่ม attributes</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form class="form-horizontal" method="post"
                            action="{{ url('/admin/add-attributes/'.$productAt['id']) }}" name="add-attributes"
                            id="add-attributes">{{ csrf_field() }}
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
                                    <input required type="text" name="sku[]" id="sku" placeholder="หน่วย" style="width: 120px" />
                                    <input required type="text" name="size[]" id="size" placeholder="ขนาด" style="width: 120px" />
                                    <input required type="text" name="price[]" id="price" placeholder="ราคา" style="width: 120px" />
                                    <input required type="text" name="stock[]" id="stock" placeholder="สินค้าใน stock" style="width: 120px" />
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
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                        <h5>แสดงคุณลักษณะของสินค้าทั้งหมด</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper" role="grid">
                            <table class="table table-bordered data-table dataTable" id="DataTables_Table_0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>หน่วย</th>
                                        <th>ขนาด</th>
                                        <th>ราคา</th>
                                        <th>สินค้าใน stock</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productAt['product_attributes'] as $key => $value)
                                        <tr>
                                            <td>{{ $value['id'] }}</td>
                                            <td>{{ $value['sku'] }}</td>
                                            <td>{{ $value['size'] }}</td>
                                            <td>{{ $value['price'] }}</td>
                                            <td>{{ $value['stock'] }}</td>
                                            <td>
                                                <a href="" class="btn btn-danger btn-mini">ลบ</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
