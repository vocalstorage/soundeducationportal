<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
//    public function index(){
//        $lessonDates = [];
//        foreach (Auth::user()->lessons as $lesson){
//            foreach ($lesson->lessonDates as $lessonDate){
//                if($lessonDate->date->isToday()){
//                    array_push($lessonDates, $lessonDate);
//                }
//            }
//        }
//
//        $data = [
//            'lessonDates' => $lessonDates
//        ];
//
//        return view('teacher.index' , $data);
//    }

    public function edit(){

        $studio = Auth::user()->studio;

        $data = [
            'studio' => $studio,
        ];
        return view('teacher.account.edit', $data);
    }

    public function update(Request $request){
        $request->validate([
            'name' => 'required',
            'email'  =>  'required|email|unique:teachers,email,'.Auth::id()
        ]);

        if($request['password']){
            $request['password'] = Hash::make($request->request->get('password'));
        }

        Auth::user()->update(array_filter($request->request->all()));

        return redirect(route('teacher-edit'));
    }

    public function appointments(){
        return view('teacher.account.appointments');
    }
}
