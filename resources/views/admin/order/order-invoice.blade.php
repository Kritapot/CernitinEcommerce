<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container">
    <div class="row">
        <div class="col-xs-12">
    		<div class="invoice-title">
    			<h2>ใบแจ้งการชำระเงิน</h2><h3 class="pull-right">หมายเลขการสั่งซื้อ # {{ $orderDetail['id'] }}</h3>
    		</div>
    		<hr>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    				<strong>ที่อยู่สำหรับส่งใบเสร็จ:</strong><br>
                    {{ $userDetail['name'] }}<br>
                    {{ $userDetail['email'] }}<br>
                    {{ $userDetail['address'] }}<br>
                    {{ $userDetail['city'] }}<br>
                    {{ $userDetail['state'] }}<br>
                    {{ $userDetail['country'] }}<br>
                    {{ $userDetail['pincode'] }}<br>
                    {{ $userDetail['mobile'] }}<br>

    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
        			<strong>ที่อยู่สำหรับจัดส่งสินค้า:</strong><br>
                    {{ $userDetail['name'] }}<br>
                    {{ $userDetail['email'] }}<br>
                    {{ $userDetail['address'] }}<br>
                    {{ $userDetail['city'] }}<br>
                    {{ $userDetail['state'] }}<br>
                    {{ $userDetail['country'] }}<br>
                    {{ $userDetail['pincode'] }}<br>
                    {{ $userDetail['mobile'] }}<br>

    				</address>
    			</div>
    		</div>
    		<div class="row">
    			<div class="col-xs-6">
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
    					<strong>วันที่ทำการสั่งซื้อ:</strong><br>
    					{{ $orderDetail['created_at'] }}<br><br>
    				</address>
    			</div>
    		</div>
    	</div>
    </div>

    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>รายละเอียดการสั่งซื้อ</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-condensed">
    						<thead>
                                <tr>
        							<td><strong>รายการ</strong></td>
        							<td class="text-center"><strong>ราคา</strong></td>
        							<td class="text-center"><strong>จำนวน</strong></td>
        							<td class="text-right"><strong>ยอดรวม</strong></td>
                                </tr>
    						</thead>
    						<tbody>
                                <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                @foreach ($orderDetail->orderProducts as $key => $value)
                                    <tr>
                                        <td>{{ $value['product_code'] }}</td>
                                        <td class="text-center">{{ $value['product_name'] }}</td>
                                        <td class="text-center">{{ $value['product_qty'] }}</td>
                                        <td class="text-right">{{ $value['product_price']*$value['product_qty'] }}</td>
                                    </tr>
                                @endforeach
    							<tr>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line text-center"><strong>รวม</strong></td>
    								<td class="thick-line text-right">THB {{ $orderDetail['grand_total'] }}</td>
    							</tr>
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>ค่าบริการจัดส่ง</strong></td>
    								<td class="no-line text-right">0</td>
    							</tr>
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>ยอดรวม</strong></td>
    								<td class="no-line text-right">THB {{ $orderDetail['grand_total'] }}</td>
    							</tr>
    						</tbody>
    					</table>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
</div>
