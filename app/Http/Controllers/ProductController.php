<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Brian2694\Toastr\Facades\Toastr;
use Session;
use Image;
use App\Category;
use App\Product;
use App\ProductAttributes;
use App\Cart;
use Auth;
use App\User;
use App\apps_country;
use App\DeliveryAddress;
use App\Order;
use Illuminate\Support\Facades\DB;
use App\OrderProduct;
use Illuminate\Support\Facades\Mail;


class ProductController extends Controller
{
    /**
     * Add product function
     *
     * @param Request $request
     * @return void
     */
    public function add_product(Request $request)
    {
        if($request->isMethod('post')){
            $data                       =   $request->all();
            if(empty($data['category_id'])) {
                return redirect()->back()->with('flash_message_errors', 'กรุณาเลือกประเภทของสินค้า');
            }

            $saveProduct                =   new Product();
            $saveProduct->product_name  =   $data['name'];
            $saveProduct->category_id   =   $data['category_id'];
            $saveProduct->product_code  =   $data['product_code'];

            if(empty($data['product_color'])) {
                $data['product_color']    =   "";
            }
            $saveProduct->product_color =   $data['product_color'];

            if(empty($data['description'])) {
                $data['description']    =   "";
            }

            $saveProduct->description   =   $data['description'];

            if(!empty($data['care'])) {
                $saveProduct->care          =   $data['care'];
            }else {
                $saveProduct->care          =   '';
            }

            $saveProduct->price         =   $data['price'];

            if(empty($data['status'])) {
                $status     =   0;
            }else {
                $status     =   1;
            }

            $saveProduct->status        =   $status;

            //Upload Image
            if($request->hasFile('image')){
                $imgTmp         =   Input::file('image');

                if($imgTmp->isValid()){
                    $extention              =   $imgTmp->getClientOriginalExtension();
                    $filename               =   rand(111, 99999).'.'.$extention;
                    $large_image_path       =   'images/backend_images/products/large/'.$filename;
                    $medium_image_path      =   'images/backend_images/products/medium/'.$filename;
                    $small_image_path       =   'images/backend_images/products/small/'.$filename;

                }
                //Resize Image
                Image::make($imgTmp)->resize(1200, 1200)->save($large_image_path);
                Image::make($imgTmp)->resize(600, 600)->save($medium_image_path);
                Image::make($imgTmp)->resize(300, 300)->save($small_image_path);

                //Save name image into database
                $saveProduct->image         =   $filename;
            }


            $saveProduct->save();
            return redirect('/admin/list-product')->with('flash_message_success', 'เพิ่มรายการสินค้าเรียบร้อยแล้ว');
        }

        $categories     =   Category::with('categories')->where('parent_id', 0)->get();
        return view('admin.product.add-product', ['categories' => $categories]);
    }

    /**
     * Show all products function
     *
     * @return void
     */
    public function list_product()
    {
        $product        =   Product::get();

        foreach ($product as $key => $value) {
            $categories_name                =   Category::where('id', $value->category_id)->first();
            $product[$key]->category_id     =   $categories_name->name;
        }

        return view('admin.product.list-product', ['product' => $product]);
    }

    /**
     * Edit Update Product function
     *
     * @param Request $request
     * @param  $id
     * @return void
     */
    public function edit_product(Request $request, $id)
    {
        if($request->isMethod('post')) {
            $data           =   $request->all();

            if(empty($data['category_id'])) {
                return redirect()->back()->with('flash_message_errors', 'กรุณาเลือกประเภทของสินค้า');
            }
            $saveProduct                =   Product::where('id', $id)->first();
            $saveProduct->product_name  =   $data['name'];
            $saveProduct->category_id   =   $data['category_id'];
            $saveProduct->product_code  =   $data['product_code'];
            if(empty($data['product_color'])) {
                $data['product_color']    =   "";
            }
            $saveProduct->product_color =   $data['product_color'];
            $saveProduct->description   =   $data['description'];

            if(empty($data['care'])) {
                $saveProduct->care      =   '';
            }else {
                $saveProduct->care      =   $data['care'];
            }

            $saveProduct->price         =   $data['price'];
                if(empty($data['status'])) {
                    $status    =   0;
                }else {
                    $status    =   1;
                }
            $saveProduct->status        =   $status;

            //Upload Image
            if($request->hasFile('image')){
                $imgTmp         =   Input::file('image');
                if($imgTmp->isValid()){
                    $extention              =   $imgTmp->getClientOriginalExtension();
                    $filename               =   rand(111, 99999).'.'.$extention;
                    $large_image_path       =   'images/backend_images/products/large/'.$filename;
                    $medium_image_path      =   'images/backend_images/products/medium/'.$filename;
                    $small_image_path       =   'images/backend_images/products/small/'.$filename;

                }
                //Resize Image
                Image::make($imgTmp)->resize(1200, 1200)->save($large_image_path);
                Image::make($imgTmp)->resize(600, 600)->save($medium_image_path);
                Image::make($imgTmp)->resize(300, 300)->save($small_image_path);
            }else{
                $filename       =   $data['current_image'];
            }

            $saveProduct->image         =   $filename;
            $saveProduct->save();

            return redirect('/admin/list-product')->with('flash_message_success', 'แก้ไขสินค้าเรียบร้อยแล้ว');
        }


        $product                =   Product::with('category')->where('id', $id)->first();
        $categories_dropdown    =   Category::with('categories')->where('parent_id', 0)->get();

        return view('admin.product.edit-product', ['product' => $product, 'categories_dropdown' => $categories_dropdown]);
    }

    /**
     * Delete picture product function
     *
     * @param $id
     * @return void
     */
    public function delete_picture($id)
    {
        // Delete picture form folder
        $product            =   Product::where('id', $id)->first();
        $small_image_path   =   "images/backend_images/products/small/";
        $medium_image_path  =   "images/backend_images/products/medium/";
        $large_image_path   =   "images/backend_images/products/large/";

        if(file_exists($small_image_path.$product->image)) {
            unlink($small_image_path.$product->image);
        }
        if(file_exists($medium_image_path.$product->image)) {
            unlink($medium_image_path.$product->image);
        }
        if(file_exists($large_image_path.$product->image)) {
            unlink($large_image_path.$product->image);
        }


        Product::where('id', $id)->update(['image' => ""]);

        return redirect()->back()->with('flash_message_success', 'ลบรูปภาพสินค้าเรียบร้อย');
    }

    /**
     * Delete product function
     *
     * @param  $id
     * @return void
     */
    public function delete_product($id) {
        Product::where('id', $id)->first()->delete();

        return redirect('/admin/list-product')->with('flash_message_success', 'ลบรายการสินค้าเรียบร้อยแล้ว');

    }

    /**
     * Add attributes product function
     *
     * @param Request $request
     * @param $id
     * @return void
     */
    public function add_attributes(Request $request, $id)
    {
        $productAt      =   Product::with('product_attributes')->where('id', $id)->first();
        if($request->isMethod('post')) {
            $data       =   $request->all();

            foreach($data['sku'] as $key => $value) {
                if(!empty($value)) {
                    $productAtCoutSize  =   ProductAttributes::where(['product_id' => $id, 'size' => $data['size'][$key]])
                                            ->count();
                        if($productAtCoutSize>0) {
                            return redirect('/admin/add-attributes/'.$id)->with('flash_message_errors','ขนาดของสินค้าจะต้องไม่ซ้ำกัน' );
                        }

                    $product_attributes                     =   new ProductAttributes();
                    $product_attributes->product_id         =   $id;
                    $product_attributes->sku                =   $value;
                    $product_attributes->size               =   $data['size'][$key];
                    $product_attributes->price              =   $data['price'][$key];
                    $product_attributes->stock              =   $data['stock'][$key];
                    $product_attributes->save();
                }
            }

            return redirect('/admin/add-attributes/'.$id)->with('flash_message_success', 'เพิ่ม attributes ให้สินค้าเรียบร้อย');
        }

        return view('admin.product.add-attributes', with(['productAt' => $productAt]));
    }

    /**
     * Edit Updated attributes function
     *
     * @param Request $request
     * @param $id
     * @return void
     */
    public function edit_attributes(Request $request, $id) {
        if($request->isMethod('post')) {
            $data       =   $request->all();

            foreach($data['idAttr'] as $key => $value) {
                ProductAttributes::where(['id' => $data['idAttr'][$key]])
                    ->update(['price' => $data['price'][$key], 'stock' => $data['stock'][$key]]);
            }
            return redirect('/admin/add-attributes/'.$id)
                    ->with('flash_message_success', 'แก้ไข attributes ให้สินค้าเรียบร้อย');
        }
    }

    /**
     * Delete attributes function
     *
     * @param  $id
     * @return void
     */
    public function delete_attributes($id)
    {
        ProductAttributes::where('id', $id)->delete();

        return redirect()->back()->with('flash_message_success', 'ลบรายการคุณลักษณะสินค้าเรียบร้อยแล้ว');
    }

    /**
     * Show orders function
     *
     * @return void
     */
    public function showOrderAdmin()
    {
        $order      =   Order::with('orderProducts')->orderBy('id', 'DESC')->get();
        return view('admin.order.list', with(['order' => $order]));
    }

    /**
     * Show orders Detail function
     *
     * @param $id
     * @return void
     */
    public function showDetailOrderAdmin($order_id)
    {
        $orderDetail    =   Order::with('orderProducts')->where('id', $order_id)->first();
        $userDetail     =   User::where('id', $orderDetail['user_id'])->first();

        return view('admin.order.order-detail', with([
            'orderDetail' => $orderDetail,
            'userDetail'  => $userDetail
        ]));
    }

    /**
     * show Invoice order function
     *
     * @param $order_id
     * @return void
     */
    public function showDetailOrderInvoice($order_id)
    {
        $orderDetail    =   Order::with('orderProducts')->where('id', $order_id)->first();
        $userDetail     =   User::where('id', $orderDetail['user_id'])->first();

        return view('admin.order.order-invoice', with([
            'orderDetail' => $orderDetail,
            'userDetail'  => $userDetail
        ]));
    }


    public function updateOrderStatus(Request $request, $id)
    {
        $data       =   $request->all();

        Order::where('id', $id)->update(['order_status' => $data['order_status']]);
        return redirect()->back()->with('flash_message_success', 'แก้ไขสถานะรายการสั่งซื้อเรียบร้อยแล้ว');

    }

    /**
     * Homepage show product from category function
     *
     * @param $url
     * @return void
     */
    public function products($url = null)
    {
        $checkNoneUrl       =   Category::where(['url' => $url, 'status' => 1])->count();

        if($checkNoneUrl == 0) {
            abort(404);
        }
        //dropdown category
        $categorise         =   Category::with('categories')->where('parent_id', 0)
                                ->get();
        // get category from $url
        $categoryDetail     =   Category::where('url', $url)->first();

        if($categoryDetail->parent_id == 0) {
            $subCategories      =   Category::where('parent_id', $categoryDetail->id)
                                    ->get();

            foreach($subCategories as $subcat) {
                $cat_ids[]      =   $subcat->id;
            }
            $productAll         =  Product::whereIn('category_id', $cat_ids)
                                            ->where('status', 1)
                                            ->get();

            $countProduct       =  Product::whereIn('category_id', $cat_ids)
                                            ->where('status', 1)
                                            ->count();

        }else {
            $productAll         =   Product::where('category_id', $categoryDetail->id)
                                            ->where('status', 1)
                                            ->get();

            $countProduct       =  Product::where('category_id', $categoryDetail->id)
                                            ->where('status', 1)
                                            ->count();

        }


        return view('products.listing', with([
            'categoryDetail'    => $categoryDetail,
            'categorise'        => $categorise,
            'productAll'        => $productAll,
            'countProduct'      => $countProduct
        ]));

    }

    /**
     * Search Product function
     *
     * @param Request $request
     * @return void
     */
    public function searchProduct(Request $request)
    {
        $data       =   $request->all();

        //dropdown category
        $categorise         =   Category::with('categories')->where('parent_id', 0)
                                ->get();
        $searchProduct      =   $data['product'];

        $productAll         =   Product::where(function($query) use($searchProduct) {
                                $query->where('product_name', 'LIKE', '%'.$searchProduct.'%')
                                    ->orWhere('description', 'LIKE', '%'.$searchProduct.'%');
                                })->where('status', 1)->get();

         $sumProductAll     =   $productAll->count();


        return view('products.search', with([
            'searchProduct'     => $searchProduct,
            'categorise'        => $categorise,
            'productAll'        => $productAll,
            'sumProductAll'     => $sumProductAll

        ]));

    }


    /**
     * Show Product detail function
     *
     * @param $id
     * @return void
     */
    public function products_detail($id)
    {
        $checkCoutProduct   =   Product::where(['status' => 1])->count();
        if($checkCoutProduct == 0) {
            abort(404);
        }
        $productDetail      =   Product::with('product_attributes')->where('id', $id)->first();

        $productRelated     =   Product::where('id', '!=', $id)->where(['category_id' => $productDetail->category_id])->get();

        $categorise         =   Category::with('categories')->where('parent_id', 0)->get();

        $totalStock         =   ProductAttributes::where('product_id', $id)->sum('stock');


        return view('products.detail', with([
            'productDetail'     => $productDetail,
            'categorise'        => $categorise,
            'totalStock'        => $totalStock,
            'productRelated'    => $productRelated
            ]));
    }

    /**
     *Page ProductDetail Get product from size function
     *
     * @param Request $request
     * @return void
     */
    public function product_from_size(Request $request)
    {
        $data               =   $request->all();
        $productAt          =   explode("-", $data['size']);

        $productPriceAt     =   ProductAttributes::where(['product_id' => $productAt[0], 'size' => $productAt[1]])
                                ->first();
        echo $productPriceAt->price;
        echo "#";
        echo $productPriceAt->stock;
    }

    /**
     * Add to cart function
     *
     * @param Request $request
     * @return void
     */
    public function add_to_cart(Request $request)
    {
        if($request->isMethod('post')) {
            $data               =   $request->all();


                $sizeArr        =   explode("-", $data['size']);

            // check qty product in stock
            $countProductStock  =   ProductAttributes::where([
                                        'product_id'    => $data['product_id'],
                                        'size'          => $sizeArr[1]
                                    ])->first();

            if($data['quantity'] > $countProductStock['stock'])
            {
                Toastr::error('ขออภัยสินค้านี้มีสต๊อค 100 ชิ้น', '', ["positionClass" => "toast-top-center", "closeButton" => true, "timeOut" => "2000", "progressBar" => true,]);
                return redirect()->back();
            }


            if(empty(Auth::user()->email)) {
                $data['user_email']   =   "";
            }else {
                $data['user_email']   =   Auth::user()->email;
            }

            if(empty($data['product_color'])) {
                $data['product_color'] = "";
            }

            // check empty session , create sesion
            $session_id     =   Session::get('session_id');
            if(empty($session_id)) {
                $session_id     =   str_random(40);
                Session::put('session_id', $session_id);
            }

            if(empty(Auth::check()))
            {
            // check add product in cart
                $countCartInProduct =   Cart::where('product_id', $data['product_id'])
                                        ->where('product_name', $data['product_name'])
                                        ->where('price', $data['price'])
                                        ->where('session_id', $session_id)
                                        ->count();

                if($countCartInProduct>0){
                    Toastr::error('ขออภัยสินค้านี้มีในตระกร้าสินค้าแล้ว', '', ["positionClass" => "toast-top-center", "closeButton" => true, "timeOut" => "2000", "progressBar" => true,]);
                    return redirect('/cart');
                }
            }else{
                // check add product in cart
                $countCartInProduct =   Cart::where('product_id', $data['product_id'])
                                        ->where('product_name', $data['product_name'])
                                        ->where('price', $data['price'])
                                        ->where('user_email', Auth::user()->email)
                                        ->count();

                if($countCartInProduct>0){
                    Toastr::error('ขออภัยสินค้านี้มีในตระกร้าสินค้าแล้ว', '', ["positionClass" => "toast-top-center", "closeButton" => true, "timeOut" => "2000", "progressBar" => true,]);
                    return redirect('/cart');
                }

            }


                $getSku                         =   ProductAttributes::select('sku')->where(['product_id'=>$data['product_id'], 'size'=>$sizeArr[1]])
                                                    ->first();

                $saveCart                       =   new Cart();
                $saveCart->product_id           =   $data['product_id'];
                $saveCart->product_name         =   $data['product_name'];
                $saveCart->product_code         =   $getSku->sku;
                $saveCart->product_color        =   $data['product_color'];
                $saveCart->size                 =   $sizeArr[1];
                $saveCart->price                =   $data['price'];
                $saveCart->quantity             =   $data['quantity'];
                $saveCart->user_email           =   $data['user_email'];
                $saveCart->session_id           =   $session_id;
                $saveCart->save();

                Toastr::success('เพิ่มสินค้าลงในตระกร้าสินค้าเรียบร้อย', '', ["positionClass" => "toast-top-center", "closeButton" => true, "timeOut" => "2000", "progressBar" => true,]);
                return redirect('/cart');



        }
    }

    /**
     * Show product in cart function
     *
     * @return void
     */
    public function cart()
    {
        //Check Auth get product show
        if(Auth::check())
        {
            $user_email     =   Auth::user()->email;
            $userCart       =   Cart::where('user_email', $user_email)->get();
            $userCartCount  =   Cart::where('user_email', $user_email)->count();
        }else {
            $session_id     =   Session::get('session_id');
            $userCart       =   Cart::where('session_id', $session_id)->get();
            $userCartCount  =   Cart::where('session_id', $session_id)->count();
        }

        foreach($userCart as $key => $value) {
            $productDetail          =   Product::where('id', $value->product_id)->first();
            $userCart[$key]->image  =   $productDetail->image;
        }

        return view('products.cart', with(['userCart' => $userCart, 'userCartCount' => $userCartCount]));
    }

    /**
     * Delere product in cart function
     *
     * @param $id
     * @return void
     */
    public function delete_cart_product($id)
    {
            Cart::where('id', $id)->delete();
            Toastr::success('ลบสินค้าออกจากตระกร้าเรียบร้อยแล้ว', '', ["positionClass" => "toast-top-center", "closeButton" => true, "timeOut" => "2000", "progressBar" => true,]);
            return redirect('/cart');
    }

    /**
     * Update quantity product cart function
     *
     * @param $id
     * @param $quantity
     * @return void
     */
    public function update_quantity($id=null, $quantity=null)
    {
            $getCartDetail      =   Cart::where('id', $id)->first();
            $getProductAtt      =   ProductAttributes::where([
                                        'sku'           => $getCartDetail->product_code,
                                        'product_id'    => $getCartDetail->product_id,
                                        'size'          => $getCartDetail->size,
                                        ])
                                    ->first();

            $updateQuantity     =   $getCartDetail->quantity + $quantity;

            if($getProductAtt->stock >= $updateQuantity){
                Cart::where('id', $id)->increment('quantity', $quantity);
                Toastr::success('เพิ่มจำนวนสินค้าเรียบร้อยแล้ว', '', ["positionClass" => "toast-top-center", "closeButton" => true, "timeOut" => "2000", "progressBar" => true,]);
                return redirect('/cart');
            }else {
                Toastr::error('ขออภัยจำนวนสินค้าใน stock มีไม่พอ', '', ["positionClass" => "toast-top-center", "closeButton" => true, "timeOut" => "2000", "progressBar" => true,]);
                return redirect('/cart');
            }

    }

    /**
     * Check out function
     *
     * @param Request $request
     * @return void
     */
    public function checkOut(Request $request)
    {
        $userId         =   Auth::user()->id;
        $userDetail     =   User::where(['id' => $userId])->first();
        $country        =   apps_country::get();

        //Count Address Delivery
        $shipCount              =   DeliveryAddress::where(['user_id' => $userId])->count();
        $deliveryDetail         =   [];
        if($shipCount>0) {
            $deliveryDetail     =   DeliveryAddress::where(['user_id' => $userId])->first();
        }

        //Update Cart with user email
        $session_id     =   Session::get('session_id');
        $user_email     =   Auth::user()->email;
        //Cart::where('session_id', $session_id)->update(['user_email' => $user_email]);

        if($request->isMethod('post'))
        {
            $data       =   $request->all();

            if(empty($data['ship_name'] || $data['ship_address'] || $data['ship_city'] || $data['ship_state'] || $data['ship_country'] || $data['ship_pincode'] || $data['ship_mobile']))
            {
                return redirect()->back()->with('flash_message_errors', 'กรุณากรอกรายละเอียดให้เรียบร้อย!');
            }

            // Update Detail User
            User::where(['id' => $userId])
                ->update([
                    'name'      =>  $data['ship_name'],
                    'address'   =>  $data['ship_address'],
                    'city'      =>  $data['ship_city'],
                    'state'     =>  $data['ship_state'],
                    'country'   =>  $data['ship_country'],
                    'pincode'   =>  $data['ship_pincode'],
                    'mobile'    =>  $data['ship_mobile'],
                ]);

            // Save to Address Table
            if($shipCount > 0)
            {
                DeliveryAddress::where(['user_id' => $userId])
                ->update([
                    'user_id'    =>  $userId,
                    'user_email' =>  Auth::user()->email,
                    'name'       =>  $data['ship_name'],
                    'address'    =>  $data['ship_address'],
                    'city'       =>  $data['ship_city'],
                    'state'      =>  $data['ship_state'],
                    'country'    =>  $data['ship_country'],
                    'pincode'    =>  $data['ship_pincode'],
                    'mobile'     =>  $data['ship_mobile'],
                ]);

            }else{
                $saveDeliverAddress                 =   new DeliveryAddress();
                $saveDeliverAddress->user_id        =   $userId;
                $saveDeliverAddress->user_email     =   Auth::user()->email;
                $saveDeliverAddress->name           =   $data['ship_name'];
                $saveDeliverAddress->address        =   $data['ship_address'];
                $saveDeliverAddress->city           =   $data['ship_city'];
                $saveDeliverAddress->state          =   $data['ship_state'];
                $saveDeliverAddress->country        =   $data['ship_country'];
                $saveDeliverAddress->pincode        =   $data['ship_pincode'];
                $saveDeliverAddress->mobile         =   $data['ship_mobile'];
                $saveDeliverAddress->save();
            }
            return redirect('/order-review');
        }


        return view('products.check-out', with([
            'userDetail'        => $userDetail,
            'country'           => $country,
            'deliveryDetail'    => $deliveryDetail
        ]));
    }

    /**
     * show order review function
     *
     * @return void
     */
    public function orderReview()
    {
        $userId             =   Auth::user()->id;
        $userDetail         =   User::where(['id' => $userId])->first();
        $deliveryDetail     =   DeliveryAddress::where('user_id', $userId)->first();
        //Check Auth get product show
        if(Auth::check())
        {
            $user_email         =   Auth::user()->email;
            $userCart           =   Cart::where('user_email', $user_email)->get();
        }

        foreach($userCart as $key => $value) {
            $productDetail          =   Product::where('id', $value->product_id)->first();
            $userCart[$key]->image  =   $productDetail->image;
        }

        return view('orders.order-review', with([
            'userDetail'        => $userDetail,
            'deliveryDetail'    => $deliveryDetail,
            'userCart'          => $userCart
        ]));
    }

    /**
     * save order and orderProducts function
     *
     * @param Request $request
     * @return void
     */
    public function placeOrder(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data                   =   $request->all();

            if(empty($data['playment_total'] && $data['playment_time'] && $data['playment_bank']))
            {
                return redirect()->back()->with('flash_message_errors', 'กรุณากรอกรายละเอียดการชำระเงินให้เรียบร้อย!');
            }

            $user_id                =   Auth::user()->id;
            $user_email             =   Auth::user()->email;
            $deliveryDetail         =   DeliveryAddress::where(['user_email' => $user_email])->first();

            $saveOrder                      =   new Order();
            $saveOrder->user_id             =   $user_id;
            $saveOrder->user_email          =   $user_email;
            $saveOrder->name                =   $deliveryDetail['name'];
            $saveOrder->address             =   $deliveryDetail['address'];
            $saveOrder->city                =   $deliveryDetail['city'];
            $saveOrder->state               =   $deliveryDetail['state'];
            $saveOrder->country             =   $deliveryDetail['country'];
            $saveOrder->pincode             =   $deliveryDetail['pincode'];
            $saveOrder->mobile              =   $deliveryDetail['mobile'];
            $saveOrder->shipping_charges    =   0;
            $saveOrder->order_status        =   "New";
            $saveOrder->playment_method     =   $data['playment_medthod'];
            $saveOrder->grand_total         =   $data['grand_total'];
            $saveOrder->playment_total      =   $data['playment_total'];
            $saveOrder->playment_time       =   $data['playment_time'];
            $saveOrder->playment_bank       =   $data['playment_bank'];
            $saveOrder->save();

            //Save to order products table
            $order_id           =   DB::getPdo()->lastInsertId();
            $cartProducts       =   Cart::where('user_email', $user_email)->get();
            foreach($cartProducts as $key => $value) {
                $product_code   =   Product::where('id', $value->product_id)->get();
                foreach($product_code as $valueCode) {
                    $cartProducts[$key]->product_code   =   $valueCode->product_code;
                }
            }

            foreach($cartProducts as $item) {
                $saveOrderProducts                  =   new OrderProduct();
                $saveOrderProducts->order_id        =   $order_id;
                $saveOrderProducts->user_id         =   $user_id;
                $saveOrderProducts->product_id      =   $item->product_id;
                $saveOrderProducts->product_code    =   $item->product_code;
                $saveOrderProducts->product_name    =   $item->product_name;
                $saveOrderProducts->product_size    =   $item->size;
                $saveOrderProducts->product_price   =   $item->price;
                $saveOrderProducts->product_qty     =   $item->quantity;
                $saveOrderProducts->save();
            }

            Session::put('order_id', $order_id);
            Session::put('grand_total', $data['grand_total']);

            //Send OrderDetail to Email
            $productDetail  =   Order::with('orderProducts')->where('id',$order_id)->first();
            $userDetail     =   User::where('id', $user_id)->first();
            $email          =   $user_email;
            $messageData    =   [
                'email'             =>   $email,
                'name'              =>   $deliveryDetail['name'],
                'order_id'          =>   $order_id,
                'productDetail'     =>   $productDetail,
                'userDetail'        =>   $userDetail
            ];
            Mail::send('email.order', $messageData, function ($message) use($email) {
                $message->to($email)->subject('รายละเอียดการสั่งซื้อ');
            });


            Cart::where('user_email', $user_email)->delete();
            return redirect('/thank-page');
        }
    }

    /**
     * TankPage  function
     *
     * @return void
     */
    public function thankPage()
    {
        return view('products.thank-page');
    }

    /**
     * Show order user function
     *
     * @return void
     */
    public function userOrderPage()
    {
        $user_id            =   Auth::user()->id;
        $orders             =   Order::with('orderProducts')->where('user_id', $user_id)->orderby('id', 'desc')->get();
        return view('orders.order-user-page', with(['orders' => $orders]));
    }

    /**
     *  Show order product detail function
     *
     * @param [type] $order_id
     * @return void
     */
    public function showOrderProduct($order_id)
    {
        $orderDetail    =   Order::with('orderProducts')->where('id', $order_id)->first();

        return view('orders.order-user-detail', with(['orderDetail' => $orderDetail]));
    }


    public function testApi()
    {
         return DB::table('users')
         ->join('orders', 'orders.user_id', 'users.id')
         ->join('order_products', 'order_products.order_id', 'orders.id')
         ->join('products', 'products.id', 'order_products.product_id')
         ->get();

    }

}
