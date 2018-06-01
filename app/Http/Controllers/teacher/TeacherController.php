<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function index(){
        return view('teacher.index');
    }

    public function edit(){
        return view('teacher.account.edit');
    }

    public function update(Request $request){
        $request->validate([
            'name' => 'required',
            'email'  =>  'required|email|unique:teachers,email,'.Auth::id()
        ]);

        if($request['password']){
            $request['password'] = Hash::make($request->request->get('password'));
        }
        Auth::user()->update($request->all());

        return view('teacher.account.edit');
    }

    public function appointments(){
        return view('teacher.account.appointments');
    }
}
