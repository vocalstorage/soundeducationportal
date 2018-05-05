<?php

namespace App\Http\Controllers\student;

use App\Lesson;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StudentLessonController extends Controller
{
    public function index(){
        $lessons = collect();
        $lessons = Lesson::all();
        $registeredLessons = [];

        foreach(\Auth::user()->lessonDateRegistrations as $lessonDateRegistration){
            $id = $lessonDateRegistration->lessonDate->lesson->id;
            if($lessons->contains($id)){
               array_push( $registeredLessons, $id);
            }
        }


        $data = [
            'lessons' => $lessons,
            'registeredLessons' =>  $registeredLessons,
        ];

        return view('student.lesson.index', $data);
    }
}
