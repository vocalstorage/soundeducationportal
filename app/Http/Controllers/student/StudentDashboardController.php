<?php

namespace App\Http\Controllers\student;

use App\Lesson;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StudentDashboardController extends Controller
{
    public function index(){

        $lessons = Lesson::all();
        $newLesson = false;


        foreach(\Auth::user()->lessonDateRegistrations as $lessonDateRegistration){
            $id = $lessonDateRegistration->lessonDate->lesson->id;
            if(!$lessons->contains($id)){
                $newLesson = true;
            }
        }

        $data = [
            'lessons' => $lessons,
            'newLesson' => $newLesson,
        ];



        return view('student.dashboard.index', $data);
    }
}
