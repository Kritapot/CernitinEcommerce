@extends('layouts.fontend-design')

@section('content')
<section id="form" style="margin-top: 20px; margin-bottom: 40px;"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form"><!--login form-->
                    <h2><strong>รายละเอียด ที่อยู่จัดส่งใบเสร็จ</strong></h2>
                    <div class="form-group">{{ $userDetail['name'] }}</div>
                    <div class="form-group">{{ $userDetail['address'] }}</div>
                    <div class="form-group">{{ $userDetail['city'] }}</div>
                    <div class="form-group">{{ $userDetail['state'] }}</div>
                    <div class="form-group">{{ $userDetail['country'] }}</div>
                    <div class="form-group">{{ $userDetail['pincode'] }}</div>
                    <div class="form-group">{{ $userDetail['mobile'] }}</div>
                </div><!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">And</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form"><!--sign up form-->
                    <h2><strong>ที่อยู่จัดส่งสินค้า</strong></h2>
                    <div class="form-group">{{ $deliveryDetail['name'] }}</div>
                    <div class="form-group">{{ $deliveryDetail['address'] }}</div>
                    <div class="form-group">{{ $deliveryDetail['city'] }}</div>
                    <div class="form-group">{{ $deliveryDetail['state'] }}</div>
                    <div class="form-group">{{ $deliveryDetail['country'] }}</div>
                    <div class="form-group">{{ $deliveryDetail['pincode'] }}</div>
                    <div class="form-group">{{ $deliveryDetail['mobile'] }}</div>
                </div><!--/sign up form-->
            </div>
        </div>
    </div>
</section><!--/form-->

<section id="cart_items">
		<div class="container">
			<div class="review-payment">
				<h2>แสดงรายละเอียดรายการสินค้า และการชำระเงิน</h2>
			</div>

			<div class="table-responsive cart_info">
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

							<td colspan="4">&nbsp;</td>
							<td colspan="2">
								<table class="table table-condensed total-result">
									<tr class="shipping-cost">
                                        <td>ค่าจัดส่ง</td>
                                        <?php $shipping = 50 ?>
                                        <td>THB <?php echo $shipping ?></td>
									</tr>
									<tr>
                                        <td>ยอดรวม</td>
                                        <?php $grandTotal = $totalAmount + $shipping ?>
										<td>THB <span> <?php echo $grandTotal; ?></span></td>
									</tr>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
            </div>
            <form name="payment-form" id="payment-form" action="{{ url('/place-order') }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="grand_total" value="{{ $grandTotal }}">
                <div class="payment-options">
                    <span>
                        <label><strong style="font-size: 1.6em">เลือกวิธีการชำระเงิน : </strong></label>
                    </span>
					<span>
						<label style="font-size: 1.6em"><input type="radio" name="playment_medthod" id="direct" value="direct"> โอนผ่านธนาคารโดยตรง</label>
					</span>
					<span>
						<label style="font-size: 1.6em"><input disabled type="radio" name="playment_medthod" id="paypal" value="paypal"> ชำระผ่าน Paypal <span style="font-size: 0.6em; color: red">**ยังไม่เปิดให้บริการในขณะนี้</span></label>
                    </span>
                    <span style="float: right">
						<button type="submit" class="btn btn-success" id="select-playment-method">ยืนยันการชำระเงิน</button>
					</span>
				</div>
            </form>
		    </div>
	</section> <!--/#cart_items-->

@endsection
