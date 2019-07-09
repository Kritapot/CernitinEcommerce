<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Session;

class UserController extends Controller
{
    /**
     * Show function
     *
     * @return void
     */
    public function userLoginRegister()
    {
        return view('user.login-register');
    }

    /**
     * register user function
     *
     * @param Request $request
     * @return void
     */
    public function register(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data           =   $request->all();
            $checkUser      =   User::where('email', $data['email'])->count();

            if($checkUser > 0)
            {
                return redirect()->back()->with('flash_message_errors', 'ขออภัย Email นี้มีผู้ใช้งานแล้ว');
            }else{
                $saveUser       =   new User();
                $saveUser->name       =   $data['name'];
                $saveUser->email       =   $data['email'];
                $saveUser->password       =   bcrypt($data['password']);
                $saveUser->save();

                if(Auth::attempt(['email' => $data['name'], 'password' => $data['password']])) {
                    Session::put('fontSession', $data['email']);
                    return redirect('/cart');
                }
            }

        }
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

    /**
     * login function
     *
     * @param Request $request
     * @return void
     */
    public function login(Request $request)
    {
        $data       =   $request->all();

        if(Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            Session::put('fontSession', $data['email']);
            return redirect('/cart');
        }else {
            return redirect()->back()-with('flash_message_errors', 'ขออภัย Email หรือ Password ไม่ถูกต้อง');
        }

    }

    /**
     * logout function
     *
     * @return void
     */
    public function logout()
    {
        Auth::logout();
        Session::forget('fontSession');
        return redirect('/');
    }


    public function userAccountPage()
    {
        return view('user.account');
    }
}
