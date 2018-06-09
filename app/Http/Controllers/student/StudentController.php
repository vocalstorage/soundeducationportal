<?php

namespace App\Http\Controllers\student;

use App\Lesson;
use App\LessonDate;
use App\Mail\LessondateScheduled;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class StudentController extends Controller
{
    public function edit(){
        return view('student.account.edit');
    }

    public function update(Request $request){
        $rules = [
            'name' => 'required',
        ];

        if(!empty($request->request->get('password'))){
            $rules['password'] = 'required|confirmed|min:6';
        }else{
            $request->request->remove('password');
        }

        $request->validate($rules);

        \Auth::user()->update($request->all());

        return view('student.account.edit');
    }

    public function appointments(){
        return view('student.account.appointments');
    }
}
