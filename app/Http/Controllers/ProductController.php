<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Session;
use Image;
use Auth;
use App\Category;
use App\Product;
use PhpParser\Node\Scalar\MagicConst\Method;
use App\ProductAttributes;
use App\Cart;

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
            $saveProduct->product_color =   $data['product_color'];
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

        }else {
            $productAll         =   Product::where('category_id', $categoryDetail->id)
                                            ->where('status', 1)
                                            ->get();
        }


        return view('products.listing', with([
            'categoryDetail'    => $categoryDetail,
            'categorise'        => $categorise,
            'productAll'        => $productAll
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

            if(empty($data['size'])) {
                $size         =   "";
            }else {
                $sizeArr        =   explode("-", $data['size']);
                $size           =   $sizeArr[1];
            }

            if(empty($data['user_email'])) {
                $data['user_email']   =   "";
            }
            // check empty session , create sesion
            $session_id     =   Session::get('session_id');
            if(empty($session_id)) {
                $session_id     =   str_random(40);
                Session::put('session_id', $session_id);
            }
            // check add product in cart
            $countCartProduct   =   Cart::where([
                'product_id'    =>  $data['product_id'],
                'product_name'  =>  $data['product_name'],
                'product_code'  =>  $data['product_code'],
                'product_color' =>  $data['product_color'],
                'price'         =>  $data['price'],
                'session_id'    =>  $session_id,
            ])->count();

            if($countCartProduct > 0){
                return redirect('/cart')
                ->with('flash_message_errors', 'มีสินค้านี้ในตระกร้าสินค้าแล้ว');
            }else {
                $getSku                         =   ProductAttributes::select('sku')->where(['product_id'=>$data['product_id'], 'size'=>$size])
                                                    ->first();

                $saveCart                       =   new Cart();
                $saveCart->product_id           =   $data['product_id'];
                $saveCart->product_name         =   $data['product_name'];
                $saveCart->product_code         =   $getSku->sku;
                $saveCart->product_color        =   $data['product_color'];
                $saveCart->size                 =   $size;
                $saveCart->price                =   $data['price'];
                $saveCart->quantity             =   $data['quantity'];
                $saveCart->user_email           =   $data['user_email'];
                $saveCart->session_id           =   $session_id;
                $saveCart->save();

            }

        }
        return redirect('/cart')
                ->with('flash_message_success', 'เพิ่มสินค้าลงใน ตระกร้าสินค้า สินค้าเรียบร้อย');
    }

    /**
     * Show product in cart function
     *
     * @return void
     */
    public function cart()
    {
        $session_id     =   Session::get('session_id');
        $userCart       =   Cart::where('session_id', $session_id)
                            ->get();
        foreach($userCart as $key => $value) {
            $productDetail          =   Product::where('id', $value->product_id)->first();
            $userCart[$key]->image  =   $productDetail->image;
        }
        //DD($userCart);
        return view('products.cart', with(['userCart' => $userCart]));
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
                return redirect('/cart')
                    ->with('flash_message_success', 'เพิ่มจำนวนสินค้าเรียบร้อย');
            }else {
                return redirect('/cart')
                    ->with('flash_message_errors', 'จำนวนสินค้าใน stock มีไม่พอ');
            }

    }
}
