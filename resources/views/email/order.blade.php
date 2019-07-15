<html>
    <body>
        <table style="width: 700px; font-size: 18px">
            <tr><td>&nbsp;</td></tr>
            <tr><td><img style="width: 200px; height: 120px;" src="{{ asset('images/fontend_images/shop/logo.jpg') }}"/></td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>สวัสดีคุณ {{ $name }}</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>ขอบคุณที่ซื้อสินค้ากับเรา : </td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>หมายเลขการสั่งซื้อของคุณคือ : {{ $order_id }}</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr>
                <td>
                    <table style="width: 95%; background-color: grey" cellpadding="5" cellspacing="5">
                        <tr style="background-color: #cccccc;">
                            <td>ชื่อสินค้า</td>
                            <td>รหัสสินค้า</td>
                            <td>ขนาด</td>
                            <td>สี</td>
                            <td>จำนวน</td>
                            <td>ราคา</td>
                        </tr>
                        @foreach ($productDetail['orderProducts'] as $product)
                            <tr>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ $product->product_code }}</td>
                                <td>{{ $product->product_size }}</td>
                                <td>{{ $product->product_color }}</td>
                                <td>{{ $product->product_qty }}</td>
                                <td>{{ $product->product_price }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="5" align="right">ยอดรวม : {{ $productDetail['grand_total'] }}</td>
                        </tr>
                    </table>
                    <tr>
                        <td>
                            <table width="100%">
                                <tr>
                                    <td width="50%">
                                        <table>
                                            <tr>
                                                <td style="font-weight: 600">
                                                    ที่อยู่สำหรับจัดส่งสินค้า
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{ $productDetail['name'] }}</td>
                                            </tr>
                                            <tr>
                                                <td>{{ $productDetail['address'] }}</td>
                                            </tr>
                                            <tr>
                                                <td>{{ $productDetail['city'] }}</td>
                                            </tr>
                                            <tr>
                                                <td>{{ $productDetail['state'] }}</td>
                                            </tr>
                                            <tr>
                                                <td>{{ $productDetail['country'] }}</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr><td>ติดต่อเราได้ที่</td></tr>
                                <tr><td>Best regard: Website Cernitin</td></tr>
                            </table>
                        </td>
                    </tr>
                </td>
            </tr>
        </table>
    </body>
</html>
