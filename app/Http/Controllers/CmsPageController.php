<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CmsPage;
use App\Category;
use Illuminate\Support\Facades\Mail;


class CmsPageController extends Controller
{
    public function addCmsPage(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data                       =       $request->all();

            if(empty($data['title']))
            {
                return redirect()->back()->with('flash_message_errors', 'กรุณากรอกรายละเอียดหัวข้อบทความ !');
            }
            if(empty($data['description']))
            {
                return redirect()->back()->with('flash_message_errors', 'กรุณากรอกรายละเอียดบทความ !');
            }

            $saveData                   =       new CmsPage();
            $saveData->title            =       $data['title'];
            $saveData->description      =       $data['description'];
            $saveData->url              =       strtolower($data['title']);
            if(empty($data['status']))
            {
                $saveData->status           =       0;
            }else{
                $saveData->status           =       1;
            }
            $saveData->save();

            return redirect()->back()->with('flash_message_success', 'เพิ่มบทความเรียบร้อยแล้ว');

        }

        return view('admin.cms-page.add-cms-page');
    }


    public function listCmsPage()
    {
        $cmsPage        =   CmsPage::orderBy('title', 'DESC')->get();

        return view('admin.cms-page.list', with(['cmsPage' => $cmsPage]));
    }


    public function delete($id)
    {
        CmsPage::where(['id' => $id])->delete();
        return redirect()->back()->with('flash_message_success', 'ลบบทความเรียบร้อยแล้ว');

    }


    public function editCmsPage(Request $request, $id)
    {
        $cmsPage        =   CmsPage::where(['id' => $id])->first();

        if($request->isMethod('post'))
        {
            $data       =   $request->all();

            if(empty($data['title']))
            {
                return redirect()->back()->with('flash_message_errors', 'กรุณากรอกรายละเอียดหัวข้อบทความ !');
            }
            if(empty($data['description']))
            {
                return redirect()->back()->with('flash_message_errors', 'กรุณากรอกรายละเอียดบทความ !');
            }


            $cmsPage->title                 =   $data['title'];
            $cmsPage->description           =   $data['description'];
            $cmsPage->url                   =   $data['title'];
            if(empty($data['status']))
            {
                $cmsPage->status            =       0;
            }else{
                $cmsPage->status            =       1;
            }

            $cmsPage->save();
            return redirect()->back()->with('flash_message_success', 'แก้ไขบทความเรียบร้อยแล้ว');


        }

        return view('admin.cms-page.edit-cms', with(['cmsPage' => $cmsPage]));
    }


    public function showCmsPage($url)
    {
        $cmsCount           =   CmsPage::where(['url' => $url, 'status' => 1])->count();
        if($cmsCount == 1)
        {
            $cmsPageDetail      =   CmsPage::where(['url' => $url, 'status' => 1])->first();
        }else {
            abort(404);
        }


        //dropdown category
        $categorise         =   Category::with('categories')->where('parent_id', 0)
                                ->get();

        return view('pages.cms-page', with([
            'cmsPageDetail' => $cmsPageDetail,
            'categorise'    => $categorise
        ]));
    }


    public function contactUs(Request $request)
    {
        if($request->isMethod('post'))
        {
             $data          =   $request->all();

             $email         =  'kritapot9999@gmail.com';
             $messageData   =   [
                 'name'         =>  $data['name'],
                 'email'        =>  $data['email'],
                 'subject'      =>  $data['subject'],
                 'comment'      =>  $data['message']

            ];

            Mail::send('email.contact', $messageData, function ($message) use($email) {
                $message->to($email)->subject('Message ถึง Cernitin');
            });

            return redirect()->back()->with('flash_message_success', 'เราได้รับข้อความของคุณแล้ว จะรีบติดต่อกลับโดยด่วน');

        }

        //dropdown category
        $categorise         =   Category::with('categories')->where('parent_id', 0)
                                ->get();

        return view('pages.contact', with([
            'categorise'    => $categorise
        ]));

    }
}
