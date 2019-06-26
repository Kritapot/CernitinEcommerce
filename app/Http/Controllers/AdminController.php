<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function log_in(Request $request)
    {
        if($request->isMethod('post')){
            $data   =   $request->input();

            if(Auth::attempt(['email' => $data['email'], 'password' => $data['password'], 'admin' => '1'])){
                return redirect('/admin/dashboard');
            }else{
                return redirect('/admin')->with('flash_message_errors', 'Invalid Username or Password');
            }
        }
        return view('admin.admin_login');
    }


    public function Dashboard()
    {
        return view('admin.dashboard');
    }


    public function logout()
    {
        Session::flush();
        return redirect('/admin')->with('flash_message_success', 'Log out successfully');
    }


    public function setting()
    {
        return view('admin.setting');
    }
}
