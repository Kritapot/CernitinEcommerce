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
        Session::forget('adminSession');
        return redirect('/admin')->with('flash_message_success', 'Log out successfully');
    }

    /**
     * Setting function
     *
     * @return view
     */
    public function setting()
    {
        $adminDetail       =    Admin::where(['username' => Session::get('adminSession')])->first();

        return view('admin.setting', with(['adminDetail'=>$adminDetail]));
    }


    public function check_password(Request $request)
    {
        $data                   =   $request->all();
        $adminCount             =   Admin::where(['username' => Session::get('adminSession'), 'password'=>md5($data['current_pwd'])])->count();

        if($adminCount == 1) {
            echo "True"; die;
        }else{
            echo "Failed"; die;
        }
    }


    public function update_password(Request $request)
    {
            $data               =   $request->all();

            $adminCount             =   Admin::where(['username' => Session::get('adminSession'), 'password'=>md5($data['current_pwd'])])->count();


            if($adminCount == 1){
                $password   =   md5($data['new_pwd']);
                Admin::where('username', Session::get('adminSession'))->update(['password' => $password]);
                return redirect('/admin/setting')->with('flash_message_success', 'เปลี่ยนรหัสผ่านเรียบร้อยแล้ว');
            }else{
                return redirect('/admin/setting')->with('flash_message_errors', 'กรอกรหัสผ่านผิด');
            }
    }


    public function listUsers()
    {
        $user       =   User::orderBy('id', 'DESC')->get();

        return view('admin.user-register.list-user', with(['user' => $user]));
    }


    public function deleteUser($id)
    {
        User::where('id', $id)->delete();
        return redirect('/admin/list-user')->with('flash_message_success', 'ลบสมาชิกรายนี้เรียบร้อยแล้ว');

    }
}
