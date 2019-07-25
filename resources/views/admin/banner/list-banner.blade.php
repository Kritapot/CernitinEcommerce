@extends('layouts.admin-layouts.design')

@section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.html" class="tip-bottom" data-original-title="Go to Home"><i
                    class="icon-home"></i> หน้าหลัก</a> <a href="#">banner</a> <a href="#"
                class="current">แสดง banner ทั้งหมด</a> </div>
        <h1>banner</h1>
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
                        <h5>แสดง Banner ทั้งหมด</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper" role="grid">
                            <table class="table table-bordered data-table dataTable" id="DataTables_Table_0">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>หัวข้อ</th>
                                        <th>Link</th>
                                        <th>รูปภาพ</th>
                                        <th>สถานะ</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <div>
                                    @foreach ($banner as $key => $item)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $item['title'] }}</td>
                                            <td>{{ $item['link'] }}</td>
                                            <td>
                                                @if (!empty($item['image']))
                                                <img style="width: 500px; height: 200px" src="{{ asset('images/fontend_images/banner/'.$item['image']) }}">
                                                @endif
                                            </td>
                                            <td>
                                                @if($item['status'] == 1) <span class="label label-success">เปิดการแสดงผล</span> @else <span class="label label-important">ปิดการแสดงผล</span> @endif
                                            </td>
                                            <td>
                                                <a href="{{ url('/admin/edit-banner/'.$item['id']) }}" class="btn btn-info btn-mini">แก้ไข</a>
                                                <a rel="{{ $item['id'] }}" rel1="delete-banner" id="delete-banner" href="javascript:" class="btn btn-danger btn-mini deleteBanner">ลบ</a>
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
