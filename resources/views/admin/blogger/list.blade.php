@extends('layouts.admin-layouts.design')

@section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.html" class="tip-bottom" data-original-title="Go to Home"><i
                    class="icon-home"></i> หน้าหลัก</a> <a href="#">บทความ</a> <a href="#"
                class="current">แสดงบทความทั้งหมด</a> </div>
        <h1>บทความ</h1>
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
                        <h5>แสดงบทความทั้งหมด</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper" role="grid">
                            <table class="table table-bordered data-table dataTable" id="DataTables_Table_0">
                                <thead>
                                    <tr>
                                        <th>รหัสบทความ</th>
                                        <th>หัวข้อ</th>
                                        <th>รูปภาพ</th>
                                        <th>สถานะ</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <div>
                                    @foreach ($blogger as $key => $item)
                                        <tr>
                                            <td>{{ $item['id'] }}</td>
                                            <td>{{ $item['title'] }}</td>
                                            <td>
                                                @if (!empty($item['image']))
                                                <img style="width: 400px; height: 150px" src="{{ asset('images/backend_images/blog/'.$item['image']) }}">
                                                @endif
                                            </td>
                                            <td>
                                                @if($item['status'] == 1) <span class="label label-success">เปิดการแสดงผล</span> @else <span class="label label-important">ปิดการแสดงผล</span> @endif
                                            </td>
                                            <td >
                                                <a href="#myModal{{ $item['id'] }}" data-toggle="modal" class="btn btn-warning btn-mini">ดูรายละเอียดบทความ</a>
                                                <a href="{{ url('/admin/edit-blogger/'.$item['id']) }}" class="btn btn-info btn-mini">แก้ไข</a>
                                                <a rel="{{ $item['id'] }}" rel1="delete-blog" id="delete-blog" href="javascript:" class="btn btn-danger btn-mini deleteBlog">ลบ</a>
                                            </td>
                                        </tr>
                                                <div id="myModal{{ $item['id'] }}" class="modal hide">
                                                    <div class="modal-header">
                                                        <button data-dismiss="modal" class="close" type="button">×</button>
                                                        <h3>รายละเอียดบทความ</h3>
                                                    </div>
                                                    <div class="modal-body" style="font-size: 1.4em">
                                                        <p><span style="font-weight: 600">รหัสบทความ :</span> {{ $item['id'] }}</p>
                                                        <p><span style="font-weight: 600">หัวข้อ :</span> {{ $item['title'] }}</p>
                                                        <p><span style="font-weight: 600">รายละเอียดบทความ :</span> {!! $item['description'] !!}</p>
                                                    </div>
                                                </div>
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
