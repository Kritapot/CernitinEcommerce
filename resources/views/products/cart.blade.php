@extends('layouts.fontend-design')

@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">ตระกร้าสินค้า</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
            @if (Session::has('flash_message_errors'))
            <div class="alert alert-error alert-block" id="message-box" style="background-color: #FF6347; color: white">
                <strong>{!! session('flash_message_errors') !!}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @elseif (Session::has('flash_message_success'))
            <div class="alert alert-success alert-block" id="message-box">
                <strong>{!! session('flash_message_success') !!}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">รายการสินค้า</td>
                        <td class="description">รายละเอียด</td>
                        <td class="price">ราคา</td>
                        <td class="quantity">จำนวน</td>
                        <td class="total">ยอดรวม</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <?php $totalAmount = 0; ?>
                    @foreach ($userCart as $key => $value)
                    <tr>
                        <td class="cart_product">
                            <a href=""><img style="width: 100px"
                                    src="{{ asset('images/backend_images/products/small/'.$value['image']) }}"
                                    alt=""></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{ $value['product_name'] }}</a></h4>
                            <p>{{ $value['product_code'] }}</p>
                        </td>
                        <td class="cart_price">
                            <p>THB  {{ $value['price'] }}</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <a class="cart_quantity_up" href="{{ url('/cart/update-quantity/'.$value['id'].'/1') }}"> + </a>
                                <input class="cart_quantity_input" type="text" name="quantity" value="{{ $value['quantity'] }}" autocomplete="off" size="2">
                                @if ($value['quantity']>1)
                                <a class="cart_quantity_down" href=""> - </a>
                                @endif
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">THB  {{ $value['price']*$value['quantity'] }}</p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href="{{ url('/cart/delete/'.$value['id']) }}"><i
                                    class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    <?php $totalAmount = $totalAmount + ($value['price']*$value['quantity']) ?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
<!--/#cart_items-->
<section id="do_action">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
            </div>
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <?php $shipping = 0 ?>
                        <li>ยอดรวมสินค้า <span>THB  <?php echo $totalAmount ?></span></li>
                        <li>ค่าจัดส่ง <span>ฟรี</span></li>
                        <li>รวม <span>THB <?php echo $totalAmount + $shipping; ?></span></li>
                    </ul>
                    <a class="btn btn-default check_out" href="{{ url('/checkout') }}">ชำระเงิน</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/#do_action-->

@endsection
