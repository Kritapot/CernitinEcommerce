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
        $product        =   Product::where('status', 1)->inRandomOrder()->paginate(6);
        $categorise     =   Category::with('categories')->where('parent_id', 0)->get();
        $banner         =   Banner::where('status', 1)->get();

        //SEO
        $meta_title             =   'เซอร์นิติน (Cernitin)';
        $meta_description       =   'ร้านค้าเซอร์นิติน, Cernitin, ต้านมะเร็ง, รักษามะเร็ง, เซอร์นิติน (Cernitin)';
        $meta_key_word          =   'ร้านข้ายเซอร์นิติน, Cernitin, Politap, Graminex, Cernitin shop, เซอร์นิติน บำบัดมะเร็ง, เซอร์นิติน ยับยั้งโรคร้าย, สู้กับมะเร็ง ด้วยสารอาหารบำบัด‎';


        return view('index', with([
            'product'           => $product,
            'categorise'        => $categorise,
            'banner'            => $banner,
            'meta_title'        => $meta_title,
            'meta_description'  => $meta_description,
            'meta_key_word'     => $meta_key_word,
        ]));
    }



}
