<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\User;

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
            $data   =   $request->input();

            if(Auth::attempt(['email' => $data['email'], 'password' => $data['password'], 'admin' => '1'])){
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
}
