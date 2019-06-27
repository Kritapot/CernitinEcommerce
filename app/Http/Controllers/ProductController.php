<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Category;
use App\Product;

class ProductController extends Controller
{
    public function add_product()
    {
        $categories             =   Category::where('parent_id', 0)->get();
        //dd($categories);
        //$category_dropdown      =   "<option selected disabled>Select</option>";
        //foreach($categories as $cat){
            //$category_dropdown  =   "<option value='".$cat->id."'>".$cat->name."</option>";
        //}

        return view('admin.product.add-product', with(['categories' => $categories]));
    }
}
