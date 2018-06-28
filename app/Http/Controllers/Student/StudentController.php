<?php

namespace App\Http\Controllers\Student;

use App\Lesson;
use App\LessonDate;
use App\Mail\LessondateScheduled;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class StudentController extends Controller
{

    public function edit(){
        return view('student.account.edit');
    }

    public function update(Request $request){
        $rules = [
            'name' => 'required|min:5',
            'email'  =>  'required|email|unique:teachers,email,'.Auth::id(),
        ];

        if(!empty($request->request->get('password'))){
            $rules = [
                'name' => 'required|min:5',
                'email'  =>  'required|email|unique:teachers,email,'.Auth::id(),
            ];
            $rules['password'] = 'required|confirmed|min:6';
        }

        $request->validate($rules);

        if(!empty($request->request->get('password'))) {
            $request['password'] = Hash::make($request->request->get('password'));
            \Auth::user()->update($request->all());
        }else{
            \Auth::user()->update($request->except('password'));
        }

        $succes_msg = "gegevens zijn aangepast";
        $data = [
            'succes_msg' => $succes_msg,
        ];

        return view('student.account.edit', $data);
    }

    public function appointments(){
        return view('student.account.appointments');
    }
}
