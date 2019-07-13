<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banner;
use Illuminate\Support\Facades\Input;
use Image;


class BannerController extends Controller
{
    public function add_banner(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data       =   $request->all();

            $saveBanner                     =   new Banner();
            if(empty($data['title'])) {
                $data['title']    =   "";
            }
            $saveBanner->title              =   $data['title'];
            if(empty($data['link'])) {
                $data['link']    =   "";
            }
            $saveBanner->link               =   $data['link'];


            if(empty($data['status'])) {
                $status     =   0;
            }else {
                $status     =   1;
            }

            $saveBanner->status             =   $status;

            //Upload Image
            if($request->hasFile('image')){
                $imgTmp         =   Input::file('image');

                if($imgTmp->isValid()){
                    $extention              =   $imgTmp->getClientOriginalExtension();
                    $filename               =   rand(111, 99999).'.'.$extention;
                    $banner_image_path       =   'images/fontend_images/banner/'.$filename;

                }
                //Resize Image
                Image::make($imgTmp)->resize(940, 380)->save($banner_image_path);

                //Save name image into database
                $saveBanner->image         =   $filename;
            }

            $saveBanner->save();
            return redirect('/admin/list-banner')->with('flash_message_success', 'เพิ่ม Banner เรียบร้อยแล้ว');
        }

        return view('admin.banner.add-banner');
    }


    public function list_banners()
    {
        $banner         =   Banner::get();

        return view('admin.banner.list-banner', with(['banner' => $banner]));
    }


    public function edit_banner(Request $request, $id)
    {
        if($request->isMethod('post'))
        {
            $data       =   $request->all();

            $saveBanner                     =   Banner::where(['id' => $id])->first();

            if(empty($data['title'])) {
                $data['title']    =   "";
            }
            $saveBanner->title              =   $data['title'];
            if(empty($data['link'])) {
                $data['link']    =   "";
            }
            $saveBanner->link               =   $data['link'];


            if(empty($data['status'])) {
                $status     =   0;
            }else {
                $status     =   1;
            }

            $saveBanner->status             =   $status;

            //Upload Image
            if($request->hasFile('image')){
                $imgTmp         =   Input::file('image');

                if($imgTmp->isValid()){
                    $extention                  =   $imgTmp->getClientOriginalExtension();
                    $filename                   =   rand(111, 99999).'.'.$extention;
                    $banner_image_path          =   'images/fontend_images/banner/'.$filename;

                }
                //Resize Image
                Image::make($imgTmp)->resize(940, 380)->save($banner_image_path);

                //Save name image into database
                $saveBanner->image         =   $filename;
            }

            $saveBanner->save();
            return redirect('/admin/list-banner')->with('flash_message_success', 'แก้ไข Banner เรียบร้อยแล้ว');
        }

        $banner         =   Banner::where(['id' => $id])->first();
        return view('admin.banner.edit-banner', with(['banner' => $banner]));
    }


    public function delete_banner($id)
    {

        $banner                     =   Banner::where('id', $id)->first();
        $banner_image_path          =   'images/fontend_images/banner/';

        if(file_exists($banner_image_path.$banner->image)) {
            unlink($banner_image_path.$banner->image);
        }

        Banner::where('id', $id)->delete();


        return redirect('/admin/list-banner')->with('flash_message_success', 'ลบ Banner เรียบร้อยแล้ว');

    }

}
