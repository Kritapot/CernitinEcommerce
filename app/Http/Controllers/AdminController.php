<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Admin;

class AdminController extends Controller
{
    /**
     * Log in function
     *
     * @param Request $request
     * @return void
     */
    public function log_in(Request $request)
    {
        if($request->isMethod('post')){
            $data           =   $request->input();
            $adminCount     =   Admin::where(['username'=>$data['username'], 'password'=>md5($data['password']), 'status'=>1])->count();

            if($adminCount > 0){
                Session::put('adminSession', $data['username']);
                return redirect('/admin/dashboard');
            }else{
                return redirect('/admin')->with('flash_message_errors', 'Invalid Username or Password');
            }
        }
        return view('admin.admin_login');
    }

    /**
     * Dashboard function
     *
     * @return view
     */
    public function Dashboard()
    {
        return view('admin.dashboard');
    }

    /**
     * Log out and clear session function
     *
     * @return view
     */
    public function logout()
    {
        Session::flush();
        return redirect('/admin')->with('flash_message_success', 'Log out successfully');
    }

    /**
     * Setting function
     *
     * @return view
     */
    public function setting()
    {
        return view('admin.setting');
    }


    public function check_password(Request $request)
    {
        $data                   =   $request->all();
        $currentPassword        =   $data['current_pwd'];
        $checkPassword          =   User::where('admin', 1)->first();

        if(Hash::check($currentPassword, $checkPassword['password'])) {
            echo "True"; die;
        }else{
            echo "Failed"; die;
        }
    }


    public function update_password(Request $request)
    {
            $data               =   $request->all();
            $checkPassword      =   User::where('email', Auth::user()->email)->first();
            $currentPassword    =   $data['current_pwd'];

            if(Hash::check($currentPassword, $checkPassword['password'])){
                $password   =   bcrypt($data['new_pwd']);
                User::where('id', 1)->update(['password' => $password]);
                return redirect('/admin/setting')->with('flash_message_success', 'เปลี่ยนรหัสผ่านเรียบร้อยแล้ว');
            }else{
                return redirect('/admin/setting')->with('flash_message_errors', 'กรอกรหัสผ่านผิด');
            }
    }
}
