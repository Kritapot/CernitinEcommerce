@extends('layouts.admin-layouts.design')

@section('content')
<!--main-container-part-->
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a
                href="#" class="current">Widgets</a> </div>
        <h1>แสดงรายละเอียดการสั่งซื้อ โดยคุณ {{ $userDetail['name'] }}</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span6">
                <div class="widget-box">
                    <div class="widget-title">
                        <h5>รายละเอียดการสั่งซ์้อ</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-striped table-bordered">
                            <tbody>
                                <tr>
                                    <td class="taskDesc">วันที่เวลา</td>
                                    <td class="taskStatus"><span
                                            class="in-progress">{{ $orderDetail['created_at'] }}</span></td>
                                </tr>
                                <tr>
                                    <td class="taskDesc">สถานะการสั่งซื้อ</td>
                                    <td class="taskStatus"><span
                                            class="in-progress">{{ $orderDetail['order_status'] }}</span></td>
                                </tr>
                                <tr>
                                    <td class="taskDesc">ยอดรวมทั้งหมด</td>
                                    <td class="taskStatus"><span
                                            class="in-progress">{{ $orderDetail['grand_total'] }}</span></td>
                                </tr>
                                <tr>
                                    <td class="taskDesc">การชำระเงิน</td>
                                    <td class="taskStatus">
                                    <span class="in-progress">{{ $orderDetail['playment_method'] == 'direct' ? 'โอนผ่านธนาคาร' : '' }}</span></td>
                                </tr>
                                <tr>
                                    <td class="taskDesc">การจัดส่ง</td>
                                    <td class="taskStatus">
                                    <span class="in-progress">{{ $orderDetail['shipping_charges'] == 50 ? $orderDetail['shipping_charges'].' '.'THB '."By Kerry" : '' }}</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="widget-box">
                    <div class="widget-title">
                        <h5>ที่อยู่จัดส่งใบเสร็จ</h5>
                    </div>
                    <div class="widget-content">
                        {{ $userDetail['name'] }}<br>
                        {{ $userDetail['email'] }}<br>
                        {{ $userDetail['address'] }}<br>
                        {{ $userDetail['city'] }}<br>
                        {{ $userDetail['state'] }}<br>
                        {{ $userDetail['country'] }}<br>
                        {{ $userDetail['pincode'] }}<br>
                        {{ $userDetail['mobile'] }}<br>
                    </div>
                </div>
            </div>
            <div class="span6">
                <div class="widget-box">
                    <div class="widget-title">
                        <h5>รายละเอียดลูกค้า</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-striped table-bordered">
                            <tbody>
                                <tr>
                                    <td class="taskDesc">ชื่อลูกค้า</td>
                                    <td class="taskStatus"><span class="in-progress">{{ $userDetail['name'] }}</span></td>
                                </tr>
                                <tr>
                                    <td class="taskDesc">อีเมล์ลูกค้า</td>
                                    <td class="taskStatus"><span class="in-progress">{{ $userDetail['email'] }}</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="widget-box">
                    <div class="widget-title">
                        <h5>ที่อยู่จัดส่งสินค้า</h5>
                    </div>
                    <div class="widget-content">
                        {{ $orderDetail['name'] }}<br>
                        {{ $orderDetail['user_email'] }}<br>
                        {{ $orderDetail['address'] }}<br>
                        {{ $orderDetail['city'] }}<br>
                        {{ $orderDetail['state'] }}<br>
                        {{ $orderDetail['country'] }}<br>
                        {{ $orderDetail['pincode'] }}<br>
                        {{ $orderDetail['mobile'] }}<br>
                    </div>
                </div>
                <div class="widget-box">
                        <div class="widget-title">
                            <h5>สถานะการชำระเงิน</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-striped table-bordered">
                                <tbody>
                                    <tr>
                                        <td class="taskDesc">ชื่อลูกค้า</td>
                                        <td class="taskStatus"><span class="in-progress">{{ $userDetail['name'] }}</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

            </div>
            <div class="widget-box">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>หมายเลขสินค้า</th>
                            <th>ชื่อสินค้า</th>
                            <th>ขนาด</th>
                            <th>ราคา</th>
                            <th>จำนวน</th>
                        </tr>
                    </thead>
                    <tbody><?php //dd($orders) ?>
                        @foreach ($orderDetail->orderProducts as $key => $value)
                        <tr>
                            <td class="text-left">{{ $value['product_code'] }}</td>
                            <td class="text-left">{{ $value['product_name'] }}</td>
                            <td class="text-left">{{ $value['product_size'] }}</td>
                            <td class="text-left">{{ $value['product_price'] }}</td>
                            <td class="text-left">{{ $value['product_qty'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!--main-container-part-->
            @endsection