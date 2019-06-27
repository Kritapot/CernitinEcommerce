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

        return redirect('/admin/show-category')->with('flash_message_success', 'บันทึกประเภทสินค้าเรียบร้อยแล้ว');

    }


    public function show_category()
    {
        $category       =   Category::get();

        return view('admin.show-category-list', with(['category' => $category]));
    }


    public function edit_category($id) {

        $category       =   Category::where('id', $id)->first();

        return view('admin.edit-category', with(['category' => $category]));
    }



    public function update_category(Request $request, $id)
    {
        $data                               =   $request->all();

        $updateCategory                     =   Category::where('id', $id)->first();
        $updateCategory->name               =   $data['name'];
        $updateCategory->description        =   $data['description'];
        $updateCategory->url               =   $data['url'];
        $updateCategory->save();

        return redirect('/admin/show-category')->with('flash_message_success', 'แก้ไขประเภทสินค้าเรียบร้อย');
    }
}
