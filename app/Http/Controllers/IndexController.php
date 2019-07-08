<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Banner;


class IndexController extends Controller
{
    public function index()
    {
        $product        =   Product::where('status', 1)->get();
        $product        =   Product::where('status', 1)->orderBy('id', 'DESC')->get();
        $product        =   Product::where('status', 1)->inRandomOrder()->get();
        $categorise     =   Category::with('categories')->where('parent_id', 0)->get();
        $banner         =   Banner::where('status', 1)->get();

        return view('index', with(['product' => $product, 'categorise' => $categorise, 'banner' => $banner]));
    }



}
