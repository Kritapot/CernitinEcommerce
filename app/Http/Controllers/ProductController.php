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

class ProductController extends Controller
{
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
            $saveProduct->price         =   $data['price'];

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
                Image::make($imgTmp)->save($large_image_path);
                Image::make($imgTmp)->resize(600, 600)->save($medium_image_path);
                Image::make($imgTmp)->resize(300, 300)->save($small_image_path);

                //Save name image into database
                $saveProduct->image         =   $filename;
            }

            $saveProduct->save();
            return redirect('/admin/list-product')->with('flash_message_success', 'เพิ่มรายการสินค้าเรียบร้อยแล้ว');
        }

        $categories     =   Category::get();
        return view('admin.product.add-product', ['categories' => $categories]);
    }


    public function list_product()
    {
        $product        =   Product::get();

        foreach ($product as $key => $value) {
            $categories_name                =   Category::where('id', $value->category_id)->first();
            $product[$key]->category_id     =   $categories_name->name;
        }

        return view('admin.product.list-product', ['product' => $product]);
    }


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
            $saveProduct->price         =   $data['price'];

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
                Image::make($imgTmp)->save($large_image_path);
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
        $categories_dropdown    =   Category::get();

        return view('admin.product.edit-product', ['product' => $product, 'categories_dropdown' => $categories_dropdown]);
    }


    public function delete_picture($id)
    {
        Product::where('id', $id)->update(['image' => ""]);

        return redirect()->back()->with('flash_message_success', 'ลบรูปภาพสินค้าเรียบร้อย');
    }
}
