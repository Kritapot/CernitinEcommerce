<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function add_category()
    {
        return view('admin.add-category');
    }


    public function save(Request $request)
    {
        $data                       =   $request->all();
        $saveCategory               =   new Category;
        $saveCategory->name         =   $data['name'];
        $saveCategory->description  =   $data['description'];
        $saveCategory->url          =   $data['url'];
        $saveCategory->save();

        return redirect('/admin/add-category')->with('flash_message_success', 'บันทึกประเภทสินค้าเรียบร้อยแล้ว');

    }
}
