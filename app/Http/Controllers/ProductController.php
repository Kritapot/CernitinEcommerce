<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
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
            if(!empty($data['image'])){
                $saveProduct->image         =   $data['image'];
            }else{
                $saveProduct->image         =   "";
            }
            $saveProduct->save();

        }

        $categories     =   Category::get();
        return view('admin.product.add-product', ['categories' => $categories]);
    }
}
