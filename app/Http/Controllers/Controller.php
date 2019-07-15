<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Category;
use App\Product;
use App\Banner;
use App\Order;
use App\User;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public static function main_categories()
    {
        $maincategories     =   Category::where('parent_id', 0)->get();

        return $maincategories;
    }


    public static function count_product()
    {
        $product     =   Product::count();

        return $product;
    }


    public static function count_category()
    {
        $category     =   Category::count();

        return $category;
    }


    public static function count_banner()
    {
        $banner     =   Banner::count();

        return $banner;
    }

    public static function count_order()
    {
        $order     =   Order::count();

        return $order;
    }

    public static function count_user()
    {
        $user     =   User::count();

        return $user;
    }





}
