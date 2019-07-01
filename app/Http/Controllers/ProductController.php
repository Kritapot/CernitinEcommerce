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

        $categories     =   Category::with('categories')->where('parent_id', 0)->get();
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
        $categories_dropdown    =   Category::with('categories')->where('parent_id', 0)->get();

        return view('admin.product.edit-product', ['product' => $product, 'categories_dropdown' => $categories_dropdown]);
    }


    public function delete_picture($id)
    {
        Product::where('id', $id)->update(['image' => ""]);

        return redirect()->back()->with('flash_message_success', 'ลบรูปภาพสินค้าเรียบร้อย');
    }


    public function delete_product($id) {
        Product::where('id', $id)->first()->delete();

        return redirect('/admin/list-product')->with('flash_message_success', 'ลบรายการสินค้าเรียบร้อยแล้ว');

    }


    public function add_attributes(Request $request, $id)
    {
        $productAt      =   Product::with('product_attributes')->where('id', $id)->first();
        if($request->isMethod('post')) {
            $data       =   $request->all();

            foreach($data['sku'] as $key => $value) {
                if(!empty($value)) {
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


    public function delete_attributes($id)
    {
        ProductAttributes::where('id', $id)->delete();

        return redirect()->back()->with('flash_message_success', 'ลบรายการคุณลักษณะสินค้าเรียบร้อยแล้ว');
    }


    public function products($url = null)
    {
        $checkNoneUrl       =   Category::where('url', $url)->count();

        if($checkNoneUrl == 0) {
            abort(404);
        }

        $categorise         =   Category::with('categories')->where('parent_id', 0)->get();

        $categoryDetail     =   Category::where('url', $url)->first();

        if($categoryDetail->parent_id == 0) {
            $subCategories      =   Category::where('parent_id', $categoryDetail->id)->get();

            foreach($subCategories as $subcat) {
                $cat_ids[]      =   $subcat->id;
            }
            $productAll         =  Product::whereIn('category_id', $cat_ids)->get();

        }else {
            $productAll         =   Product::where('category_id', $categoryDetail->id)->get();
        }


        return view('products.listing', with(['categoryDetail' => $categoryDetail, 'categorise' => $categorise, 'productAll' => $productAll]));

    }
}
