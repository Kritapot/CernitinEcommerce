<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class IndexController extends Controller
{
    public function index()
    {
        $product        =   Product::inRandomOrder()->get();

        return view('index', with(['product' => $product]));
    }
}
