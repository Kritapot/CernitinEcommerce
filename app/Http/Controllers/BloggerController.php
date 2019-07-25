<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Image;
use App\Blogger;
use App\Category;

class BloggerController extends Controller
{

    /**
     * Add Blogger function
     *
     * @param $request
     * @return void
     */
    public function addBlogger(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data       =   $request->all();

            if(empty($data['title']))
            {
                return redirect()->back()->with('flash_message_errors', 'กรุณากรอกรายละเอียดหัวข้อ');
            }
            if(empty($data['description']))
            {
                return redirect()->back()->with('flash_message_errors', 'กรุณากรอกรายละเอียดบทความ');
            }

            $saveBlogger                    =   new Blogger();
            $saveBlogger->title             =   $data['title'];
            $saveBlogger->description       =   $data['description'];
            if(empty($data['status']))
            {
                $saveBlogger->status        =   0;
            }else {
                $saveBlogger->status        =   1;
            }

            //Upload Image
            if($request->hasFile('image')){
                $imgTmp         =   Input::file('image');

                if($imgTmp->isValid()){
                    $extention              =   $imgTmp->getClientOriginalExtension();
                    $filename               =   rand(111, 99999).'.'.$extention;
                    $medium_image_path      =   'images/backend_images/blog/'.$filename;
                }
                //Resize Image
                Image::make($imgTmp)->resize(900, 900)->save($medium_image_path);

                //Save name image into database
                $saveBlogger->image         =   $filename;
            }

            $saveBlogger->save();
            return redirect('admin/list-blogger')->with('flash_message_success', 'เพิ่มบทความเรียบร้อยแล้ว');

        }

        return view('admin.blogger.add-blogger');
    }

    /**
     * Lists function
     *
     * @return void
     */
    public function list()
    {
        $blogger        =   Blogger::orderBy('id', 'DESC')->get();

        return view('admin.blogger.list', with(['blogger' => $blogger]));
    }

    /**
     * Delete function
     *
     * @param $id
     * @return void
     */
    public function delete($id)
    {

        // Delete picture form folder
        $blogger            =   Blogger::where('id', $id)->first();
        $medium_image_path  =   "images/backend_images/blog/";
        if(file_exists($medium_image_path.$blogger->image)) {
            unlink($medium_image_path.$blogger->image);
        }

        Blogger::where('id', $id)->delete();


        return redirect()->back()->with('flash_message_success', 'ลบบทความเรียบร้อยแล้ว');

    }

    /**
     * Edit function
     *
     * @param Request $request
     * @param  $id
     * @return void
     */
    public function editBlogger(Request $request, $id)
    {
        $blogger            =   Blogger::where(['id' => $id])->first();

        if($request->isMethod('post'))
        {
            $data       =   $request->all();

            if(empty($data['title']))
            {
                return redirect()->back()->with('flash_message_errors', 'กรุณากรอกรายละเอียดหัวข้อ');
            }
            if(empty($data['description']))
            {
                return redirect()->back()->with('flash_message_errors', 'กรุณากรอกรายละเอียดบทความ');
            }

            $blogger->title             =   $data['title'];
            $blogger->description       =   $data['description'];
            if(empty($data['status']))
            {
                $blogger->status        =   0;
            }else {
                $blogger->status        =   1;
            }

            //Upload Image
            if($request->hasFile('image')){
                $imgTmp         =   Input::file('image');

                if($imgTmp->isValid()){
                    $extention              =   $imgTmp->getClientOriginalExtension();
                    $filename               =   rand(111, 99999).'.'.$extention;
                    $medium_image_path      =   'images/backend_images/blog/'.$filename;
                }
                //Resize Image
                Image::make($imgTmp)->resize(900, 900)->save($medium_image_path);

            }else {
                $filename       =   $data['current_image'];
            }

            //Save name image into database
            $blogger->image         =   $filename;


            $blogger->save();


            return redirect('admin/list-blogger')->with('flash_message_success', 'แก้ไขบทความเรียบร้อยแล้ว');

        }

        return view('admin.blogger.edit-blogger', with(['blogger' => $blogger]));
    }


    public function showDetailBlog($id)
    {
        $blogDetail     =   Blogger::where('id', $id)->first();

        //dropdown category
        $categorise         =   Category::with('categories')->where('parent_id', 0)
                                ->get();


        return view('blog.blog-detail', with(['blogDetail' => $blogDetail, 'categorise' => $categorise]));
    }
}
