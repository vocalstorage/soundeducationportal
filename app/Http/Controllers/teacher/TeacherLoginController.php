<?php

namespace App\Http\Controllers\teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TeacherLoginController extends Controller
{

    public function __construct(){
        $this->middleware('guest');
    }

    public function showLoginForm(){
        return view('teacher.auth.login');
    }

    public function login(Request $request){
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);


        if(Auth::guard('teacher')->attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect(route('teacher-dashboard'));
        }
        dd($request);
        return redirect()->back()->withInput($request->only('email','remember'));
    }
}
