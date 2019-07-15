@extends('layouts.admin-layouts.design')

@section('content')
<div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="index.html" class="tip-bottom" data-original-title="Go to Home"><i
                        class="icon-home"></i> หน้าหลัก</a> <a href="#">รายชื่อสมาชิก</a> <a href="#"
                    class="current">แสดงรายชื่อสมาชิกทั้งหมด</a> </div>
            <h1>รายชื่อสมาชิก</h1>
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
                            <h5>แสดงรายชื่อสมาชิกทั้งหมด</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper" role="grid">
                                <table class="table table-bordered data-table dataTable" id="DataTables_Table_0">
                                    <thead>
                                        <tr>
                                            <th>หมายเลข</th>
                                            <th>ชื่อ</th>
                                            <th>อีเมล์</th>
                                            <th>ที่อยู่</th>
                                            <th>อำเภอ</th>
                                            <th>จังหวัด</th>
                                            <th>ประเทศ</th>
                                            <th>รหัสไปรษณีย์</th>
                                            <th>เบอร์โทร</th>
                                            <th>วันที่สมัคร</th>
                                            <th>การจัดการ</th>
                                        </tr>
                                    </thead>
                                    <div>
                                        @foreach ($user as $key =>$value)
                                            <tr>
                                                <td style="text-align: right">{{ $key+1 }}</td>
                                                <td style="text-align: right">{{ $value['name'] }}</td>
                                                <td style="text-align: right">{{ $value['email'] }}</td>
                                                <td style="text-align: right">{{ $value['address'] }}</td>
                                                <td style="text-align: right">{{ $value['city'] }}</td>
                                                <td style="text-align: right">{{ $value['state'] }}</td>
                                                <td style="text-align: right">{{ $value['country'] }}</td>
                                                <td style="text-align: right">{{ $value['pincode'] }}</td>
                                                <td style="text-align: right">{{ $value['mobile'] }}</td>
                                                <td style="text-align: right">{{ $value['created_at'] }}</td>
                                                <td>
                                                    <a href="{{ url('/admin/delete-user/'.$value['id']) }}" class="btn btn-danger btn-mini">ลบ</a>
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
