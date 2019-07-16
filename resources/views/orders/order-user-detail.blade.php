@extends('layouts.fontend-design')

@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{ url('/order-user-page') }}">กลับไป</a></li>
                <li>รายการสั่งซื้อ</li>
                <li class="active">รายละเอียด</li>

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
    </div>
</section>
<!--/#do_action-->
@endsection

