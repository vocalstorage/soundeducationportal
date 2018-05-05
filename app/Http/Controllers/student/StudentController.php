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
        $request->validate([
            'name' => 'required|unique:students',
            'email' => 'required|unique:students',
        ]);

        \Auth::user()->update($request->all());

        return view('student.account.edit');
    }

    public function appointments(){
        return view('student.account.appointments');
    }
}
