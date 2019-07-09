<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function register(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data           =   $request->all();

            $checkUser      =   User::where('email', $data['email'])->count();

            if($checkUser > 0)
            {
                return redirect()->back()->with('flash_message_errors', 'ขออภัย Email นี้มีผู้ใช้งานแล้ว');
            }

        }

        return view('user.login-register');
    }


    public function checkEmail(Request $request)
    {
        $data               =   $request->all();
        $checkEmail         =   User::where('email', $data['email'])->count();

        if($checkEmail>0)
        {
            echo "False";
        }else{
            echo "True";
        }
    }
}
