<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Image;
use App\Gallery;

class GalleryController extends Controller
{
    /**
     * Add gallery function
     *
     * @param  $request
     * @return void
     */
    public function addGallery(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data           =   $request->all();

            if(empty($data['image']))
            {
                return redirect()->back()->with('flash_message_errors', 'กรุณาเลือกรูปภาพของคุณ');
            }

            $saveGallery        =   new Gallery();
            if(empty($data['status']))
            {
                $saveGallery->status        =   0;
            }else {
                $saveGallery->status        =   1;
            }

            //Upload Image
            if($request->hasFile('image')){
                $imgTmp         =   Input::file('image');

                if($imgTmp->isValid()){
                    $extention              =   $imgTmp->getClientOriginalExtension();
                    $filename               =   rand(111, 99999).'.'.$extention;
                    $medium_image_path      =   'images/backend_images/gallery/medium/'.$filename;
                    $small_image_path       =   'images/backend_images/gallery/small/'.$filename;

                }
                //Resize Image
                Image::make($imgTmp)->resize(244.13, 162.61)->save($small_image_path);
                Image::make($imgTmp)->resize(626, 487)->save($medium_image_path);

                //Save name image into database
                $saveGallery->image         =   $filename;
            }

            $saveGallery->save();
            return redirect('admin/list-gallery')->with('flash_message_success', 'เพิ่มรูปภาพเรียบร้อยแล้ว');


        }

        return view('admin.gallery.add-gallery');
    }

    /**
     * lists gallery function
     *
     * @return void
     */
    public function list()
    {
        $gallery        =   Gallery::orderBy('id', 'DESC')->get();

        return view('admin.gallery.list-gallery', with(['gallery'=> $gallery]));
    }

    /**
     * Delete function
     *
     * @param [type] $id
     * @return void
     */
    public function delete($id)
    {
        // Delete picture form folder
        $gallery            =   Gallery::where('id', $id)->first();
        $medium_image_path  =   "images/backend_images/gallery/medium/";
        $small_image_path   =   "images/backend_images/gallery/small/";

        if(file_exists($medium_image_path.$gallery->image)) {
            unlink($medium_image_path.$gallery->image);
        }
        if(file_exists($small_image_path.$gallery->image)) {
            unlink($small_image_path.$gallery->image);
        }

        Gallery::where('id', $id)->delete();


        return redirect()->back()->with('flash_message_success', 'ลบรูปภาพเรียบร้อยแล้ว');
    }

}
