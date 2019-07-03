@extends('layouts.fontend-design')

@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Shopping Cart</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
            @if (Session::has('flash_message_success'))
            <div class="alert alert-success alert-block" id="message-box">
                <strong>{!! session('flash_message_success') !!}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @if (Session::has('flash_message_errors'))
            <div class="alert alert-error alert-block" id="message-box">
                <strong>{!! session('flash_message_errors') !!}</strong>
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
                            <p>THB{{ $value['price'] }}</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <a class="cart_quantity_up"
                                    href="{{ url('/cart/update-quantity/'.$value['id'].'/1') }}"> + </a>
                                <input class="cart_quantity_input" type="text" name="quantity"
                                    value="{{ $value['quantity'] }}" autocomplete="off" size="2">
                                @if ($value['quantity']>1)
                                <a class="cart_quantity_down" href=""> - </a>
                                @endif
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price"></p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href="{{ url('/cart/delete/'.$value['id']) }}"><i
                                    class="fa fa-times"></i></a>
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
<!--/#cart_items-->
<section id="do_action">
    <div class="container">
        <div class="heading">
            <h3>What would you like to do next?</h3>
            <p>Choose if you have a discount code or reward points you want to use or would like to estimate your
                delivery cost.</p>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="chose_area">
                    <ul class="user_option">
                        <li>
                            <input type="checkbox">
                            <label>Use Coupon Code</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Use Gift Voucher</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Estimate Shipping & Taxes</label>
                        </li>
                    </ul>
                    <ul class="user_info">
                        <li class="single_field">
                            <label>Country:</label>
                            <select>
                                <option>United States</option>
                                <option>Bangladesh</option>
                                <option>UK</option>
                                <option>India</option>
                                <option>Pakistan</option>
                                <option>Ucrane</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>

                        </li>
                        <li class="single_field">
                            <label>Region / State:</label>
                            <select>
                                <option>Select</option>
                                <option>Dhaka</option>
                                <option>London</option>
                                <option>Dillih</option>
                                <option>Lahore</option>
                                <option>Alaska</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>

                        </li>
                        <li class="single_field zip-field">
                            <label>Zip Code:</label>
                            <input type="text">
                        </li>
                    </ul>
                    <a class="btn btn-default update" href="">Get Quotes</a>
                    <a class="btn btn-default check_out" href="">Continue</a>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li>Cart Sub Total <span>$59</span></li>
                        <li>Eco Tax <span>$2</span></li>
                        <li>Shipping Cost <span>Free</span></li>
                        <li>Total <span>$61</span></li>
                    </ul>
                    <a class="btn btn-default update" href="">Update</a>
                    <a class="btn btn-default check_out" href="">Check Out</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/#do_action-->

@endsection
