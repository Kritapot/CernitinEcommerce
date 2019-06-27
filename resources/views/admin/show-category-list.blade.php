@extends('layouts.admin-layouts.design')

@section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.html" class="tip-bottom" data-original-title="Go to Home"><i
                    class="icon-home"></i> หน้าหลัก</a> <a href="#">ประเภทสินค้า</a> <a href="#"
                class="current">แสดงประเภทสินค้าทั้งหมด</a> </div>
        <h1>ประเภทสินค้า</h1>
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
                        <h5>แสดงประเภทสินค้าทั้งหมด</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper" role="grid">
                            <table class="table table-bordered data-table dataTable" id="DataTables_Table_0">
                                <thead>
                                    <tr role="row">
                                        <th class="ui-state-default" role="columnheader" tabindex="0"
                                            aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                            aria-sort="ascending"
                                            aria-label="Rendering engine: activate to sort column descending"
                                            style="width: 102px;">
                                            <div class="DataTables_sort_wrapper">รหัสประเภทสินค้า<span
                                                    class="DataTables_sort_icon css_right ui-icon ui-icon-triangle-1-n"></span>
                                            </div>
                                        </th>
                                        <th class="ui-state-default" role="columnheader" tabindex="0"
                                            aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                            aria-label="Browser: activate to sort column ascending"
                                            style="width: 329px;">
                                            <div class="DataTables_sort_wrapper">ชื่อประเภทสินค้า<span
                                                    class="DataTables_sort_icon css_right ui-icon ui-icon-carat-2-n-s"></span>
                                            </div>
                                        </th>
                                        <th class="ui-state-default" role="columnheader" tabindex="0"
                                            aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                            aria-label="Platform(s): activate to sort column ascending"
                                            style="width: 399px;">
                                            <div class="DataTables_sort_wrapper">รายละเอียด<span
                                                    class="DataTables_sort_icon css_right ui-icon ui-icon-carat-2-n-s"></span>
                                            </div>
                                        </th>
                                        <th class="ui-state-default" role="columnheader" tabindex="0"
                                            aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                            aria-label="Engine version: activate to sort column ascending"
                                            style="width: 173px;">
                                            <div class="DataTables_sort_wrapper">Url<span
                                                    class="DataTables_sort_icon css_right ui-icon ui-icon-carat-2-n-s"></span>
                                            </div>
                                        </th>
                                        <th class="ui-state-default" role="columnheader" tabindex="0"
                                        aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                        aria-label="Engine version: activate to sort column ascending"
                                        style="width: 173px;">
                                        <div class="DataTables_sort_wrapper">Action<span
                                                class="DataTables_sort_icon css_right ui-icon ui-icon-carat-2-n-s"></span>
                                        </div>
                                    </th>
                                    </tr>
                                </thead>

                                <tbody role="alert" aria-live="polite" aria-relevant="all">
                                    @foreach ($category as $item)
                                        <tr class="gradeA odd">
                                            <td class="  sorting_1">{{ $item->id }}</td>
                                            <td class="">{{ $item->name }}</td>
                                            <td class="">{{ $item->description }}</td>
                                            <td class="">{{ $item->url }}</td>
                                            <td class="">
                                                <a href="{{ url('/admin/edit-category/'.$item->id) }}" class="btn btn-info btn-mini">แก้ไข</a>
                                                <button class="btn btn-danger btn-mini">ลบ</button>
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
