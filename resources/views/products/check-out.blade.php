@extends('layouts.fontend-design')

@section('content')
<section id="form" style="margin-top: 20px"><!--form-->
    <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">checkout</li>
                </ol>
            </div>
            @if (Session::has('flash_message_success'))
            <div class="alert alert-error alert-block" id="message-box" style="background-color: #00C851">
                <strong style="color: white">{!! session('flash_message_success') !!}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @if (Session::has('flash_message_errors'))
            <div class="alert alert-error alert-block" id="message-box" style="background-color: #ff4444">
                <strong style="color: white">{!! session('flash_message_errors') !!}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form"><!--login form-->
                    <form action="#">
                        <h2>ที่อยู่จัดส่งใบเสร็จ</h2>
                        <input type="text" id="billing_address" name="billing_address" value="{{ !empty($userDetail['address']) ? $userDetail['address'] : '' }}" placeholder="Address" />
                        <input type="text" id="billing_city" name="billing_city" value="{{ !empty($userDetail['city']) ? $userDetail['city'] : '' }}" placeholder="City" />
                        <input type="text" id="billing_state" name="billing_state" value="{{ !empty($userDetail['state']) ? $userDetail['state'] : '' }}" placeholder="State" />
                        <select name="billing_country" id="billing_country">
                            <option value="">select country</option>
                            @foreach ($country as $key => $item)
                                <option {{ !empty($userDetail['country']) && $userDetail['country'] == $item['country_name'] ? 'selected' : '' }} value="{{ $item['country_name'] }}">{{ $item['country_name'] }}</option>
                            @endforeach
                        </select>
                        <input style="margin-top: 10px" type="text" id="billing_pincode" name="billing_pincode" value="{{ !empty($userDetail['pincode']) ? $userDetail['pincode'] : '' }}" placeholder="Pincode" />
                        <input type="text" id="billing_mobile" name="billing_mobile" value="{{ !empty($userDetail['mobile']) ? $userDetail['mobile'] : '' }}" placeholder="Mobile" />
                        <span>
                            <input type="checkbox" class="checkbox" id="copy-address">
                            ที่อยู่จัดส่งสินค้าที่เดียวกันกับ ที่อยู่จัดส่งใบเสร็จ
                        </span>
                    </form>
                </div><!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">OR</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form"><!--sign up form-->
                    <h2>ที่อยู่จัดส่งสินค้า</h2>
                    <form name="ship-form-save" id="ship-form-save" enctype="multipart/form-data" action="{{ url('/checkout') }}" method="post">
                        {{ csrf_field() }}
                        <input type="text" value="{{ !empty($deliveryDetail['name']) ? $deliveryDetail['name'] : '' }}" placeholder="Shipping Name" name="ship_name" id="ship_name" />
                        <input type="text" value="{{ !empty($deliveryDetail['address']) ? $deliveryDetail['address'] : '' }}" placeholder="Shipping Address" name="ship_address" id="ship_address" />
                        <input type="text" value="{{ !empty($deliveryDetail['city']) ? $deliveryDetail['city'] : '' }}" placeholder="Shipping City" name="ship_city" id="ship_city" />
                        <input type="text" value="{{ !empty($deliveryDetail['state']) ? $deliveryDetail['state'] : '' }}" placeholder="Shipping State" name="ship_state" id="ship_state" />
                        <select name="ship_country" id="ship_country">
                            <option value="">select country</option>
                            @foreach ($country as $key => $item)
                                <option {{ !empty($deliveryDetail['country']) && $deliveryDetail['country'] == $item['country_name'] ? 'selected' : '' }} value="{{ $item['country_name'] }}">{{ $item['country_name'] }}</option>
                            @endforeach
                        </select>
                        <input style="margin-top: 10px" type="text" value="{{ !empty($deliveryDetail['pincode']) ? $deliveryDetail['pincode'] : '' }}" placeholder="Shipping Pincode" name="ship_pincode" id="ship_pincode" />
                        <input type="text" value="{{ !empty($deliveryDetail['mobile']) ? $deliveryDetail['mobile'] : '' }}" placeholder="Shipping Mobile" name="ship_mobile" id="ship_mobile" />
                        <button type="submit" class="btn btn-default">ชำระเงิน</button>
                    </form>
                </div><!--/sign up form-->
            </div>
        </div>
    </div>
</section><!--/form-->

@endsection
