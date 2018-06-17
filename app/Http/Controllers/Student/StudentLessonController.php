<?php

namespace App\Http\Controllers\Student;

use App\Lesson;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class StudentLessonController extends Controller
{
    public function index(){
        $lessons = Lesson::where('schoolgroup_id', '=',\Auth::user()->schoolgroup->id)
            ->where('deadline', '>', Carbon::today())->orderBy('deadline', 'desc')->get();

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
