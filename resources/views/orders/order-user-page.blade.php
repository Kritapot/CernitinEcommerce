@extends('layouts.fontend-design')

@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li class="active">รายการสั่งซื้อ</li>
            </ol>
        </div>
    </div>
</section>
<!--/#cart_items-->
<section id="do_action">
    <div class="container">
        <div class="heading text-center" style="font-size: 18px">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>หมายเลขการสั่งซื้อ</th>
                                <th>รายการสินค้าที่ซื้อ</th>
                                <th>รูปแบบการชำระเงิน</th>
                                <th>ยอดรวม</th>
                                <th>วันเวลา</th>
                            </tr>
                        </thead>
                        <tbody><?php //dd($orders) ?>
                            @foreach ($orders as $key => $value)
                                <tr>
                                    <td class="text-left">{{ $value['id'] }}</td>
                                    <td class="text-left">
                                        @foreach ($value->orderProducts as $key => $product)
                                            <a href="{{ url('/order-user-page/'.$product['order_id']) }}">{{ $key+1 }}. {{ $product['product_name'] }}</a><br>
                                        @endforeach
                                    </td>
                                    <td class="text-left">{{ $value['playment_method'] == "direct" ? "โอนตรงผ่านธนาคาร" : '' }}</td>
                                    <td class="text-left">{{ $value['grand_total'] }}</td>
                                    <td class="text-left">{{ $value['created_at'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
        </div>
    </div>
</section>
<!--/#do_action-->
@endsection

