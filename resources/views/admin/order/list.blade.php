@extends('layouts.admin-layouts.design')

@section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.html" class="tip-bottom" data-original-title="Go to Home"><i
                    class="icon-home"></i> หน้าหลัก</a> <a href="#">รายการสั่งซื้อ</a> <a href="#"
                class="current">แสดงรายการสั่งซื้อทั้งหมด</a> </div>
        <h1>รายการสั่งซื้อ</h1>
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
                    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                        <h5>แสดงรายการสั่งซื้อทั้งหมด</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper" role="grid">
                            <table class="table table-bordered data-table dataTable" id="DataTables_Table_0">
                                <thead>
                                    <tr>
                                        <th>หมายเลขการสั่งซื้อ</th>
                                        <th>วันที่ เวลา</th>
                                        <th>ชื่อลูกค้า</th>
                                        <th>อีเมล์ลูกค้า</th>
                                        <th>รายการสินค้า</th>
                                        <th>ยอดรวมทั้งหมด</th>
                                        <th>สถานะ</th>
                                        <th>ประเภทการชำระเงิน</th>
                                        <th>การจัดการ</th>
                                    </tr>
                                </thead>
                                <div>
                                    @foreach ($order as $key =>$value)
                                        <tr>
                                            <td style="text-align: right">{{ $value['id'] }}</td>
                                            <td style="text-align: right">{{ $value['created_at'] }}</td>
                                            <td style="text-align: right">{{ $value['name'] }}</td>
                                            <td style="text-align: right">{{ $value['user_email'] }}</td>
                                            <td style="text-align: left">
                                                @foreach ($value->orderProducts as $key => $product)
                                                    - {{ $product['product_name'] }}<br>
                                                @endforeach
                                            </td>
                                            <td style="text-align: right">{{ $value['grand_total'] }}</td>
                                            <td style="text-align: right">{{ $value['order_status'] }}</td>
                                            <td style="text-align: right">{{ $value['playment_method'] == "direct" ? "โอนเงินผ่านธนาคาร" : '' }}</td>
                                            <td>
                                                <a href="{{ url('/admin/list-order/'.$value['id']) }}" class="btn btn-info btn-mini">ดูรายละเอียดการสั่งซื้อ</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </div>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
