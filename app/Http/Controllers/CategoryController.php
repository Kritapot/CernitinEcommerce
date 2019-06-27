<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    /**
     * show form add-category function
     *
     * @return void
     */
    public function add_category()
    {
        $levelCategory      =   Category::where('parent_id', 0)->get();
        return view('admin.add-category', with(['levelCategory' => $levelCategory]));
    }

    /**
     * save function
     *
     * @param Request $request
     * @return void
     */
    public function save(Request $request)
    {
        $data                       =   $request->all();
        $saveCategory               =   new Category;
        $saveCategory->name         =   $data['name'];
        $saveCategory->parent_id    =   $data['parent_id'];
        $saveCategory->description  =   $data['description'];
        $saveCategory->url          =   $data['url'];
        $saveCategory->save();

        return redirect('/admin/show-category')->with('flash_message_success', 'บันทึกประเภทสินค้าเรียบร้อยแล้ว');

    }

    /**
     * list function
     *
     * @return void
     */
    public function show_category()
    {
        $category       =   Category::get();

        return view('admin.show-category-list', with(['category' => $category]));
    }

    /**
     * show form edit function
     *
     * @param [type] $id
     * @return void
     */
    public function edit_category($id) {

        $category       =   Category::where('id', $id)->first();
        $levelCategory      =   Category::get();

        return view('admin.edit-category', with(['category' => $category, 'levelCategory' => $levelCategory]));
    }


    /**
     * update function
     *
     * @param Request $request
     * @param [type] $id
     * @return void
     */
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


    /**
     * delete function
     *
     * @param [type] $id
     * @return void
     */
    public function delete_category($id)
    {
        Category::where('id', $id)->first()->delete();

        return redirect()->back()->with('flash_message_success', 'ลบประเภทสินค้าเรียบร้อย');
    }
}
