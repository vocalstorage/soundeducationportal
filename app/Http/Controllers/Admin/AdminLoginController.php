<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function __construct(){
        $this->middleware('guest');
    }

    public function showLoginForm(){
        return view('admin.auth.login');
    }

    public function login(Request $request){
        $this->validate($request,[
           'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)){
            return redirect(route('admin-dashboard'));
        }
        return redirect()->back()->withInput($request->only('email','remember'));
    }
}
