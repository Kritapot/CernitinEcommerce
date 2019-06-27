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
        $categories                     =   Category::get();

        return view('admin.product.add-product', ['categories' => $categories]);
    }
}
