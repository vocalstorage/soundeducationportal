<?php

namespace App\Http\Controllers;

use App\LessonDate;
use Illuminate\Http\Request;
use App\Teacher;
use App\Lesson;
use Carbon\Carbon;

class AdminLessonController extends Controller
{
    public function index(){
        $lessons = Lesson::has('lessonDates')->with('lessonDates')->paginate(7);
        $view = 'index';


        $lastDate = "empty";
        $data = [
            'lessons' => $lessons,
            'lastDate' => $lastDate,
            'view' => $view,
        ];

        return view('admin.lesson.index', $data);
    }

    public function create(){

        $teachers = Teacher::all();
        $lesson_date = "";
        $view = 'create';

        $i = 1;
        $times = "";
        while ($i <= 24) {
            $number = $i / 6;
            $firstNumber = 0;
            if ($i > 9) {
                $firstNumber = "";
            }
            if (floor($number) == $number) {
                $times .= '<td><span class="time">'. $firstNumber . $i . ':00</span></td>';
                $times .= '</tr>';
                $times .='<tr>';
            } else {
                $times .='<td ><span class="time">' . $firstNumber . $i . ':00</span></td>';
            }
            $i++;
        }

        $data = [
            'teachers' => $teachers,
            'lesson_date' => $lesson_date,
            'times' => $times,
            'view' => 'create',
        ];

        return view('admin.lesson.create', $data);
    }

    public function store(Request $request){
        //$request->request('deadline')->get()

        $lesson = Lesson::create([
                'title' => $request->request->get('title'),
                'description' => $request->request->get('description'),
                'max_registration' => $request->request->get('max_registration'),
            ]
        );

        $lessonDates = $request->request->get('dates');

        foreach ($lessonDates as $lessonDate){
            //first get the date out of array

            //json object
            $lessonDate = json_decode(urldecode($lessonDate));

            $teacher = Teacher::find($lessonDate->teacher_id);

            //then get al the times
            $times = $lessonDate->times;

            foreach($times as $time){
                $lessonDateId = $lesson->lessonDates()->create([
                    'date' =>   date('Y-m-d',strtotime($lessonDate->date)),
                    'deadline' => $lessonDate->deadline,
                    'time' => $time,
                    'teacher_id' => $lessonDate->teacher_id,
                    'registrations' => '0',
                ])->id;
            }


            $lessonDate = LessonDate::find($lessonDateId);
            $teacher->lessons()->save($lessonDate);
            //$lessonDate->->save($teacher);
        }

        return redirect(route('admin-lesson-index'));
    }

    public function delete($id){
        $lessonDate = LessonDate::find($id);
        $lessonDate->delete();

        return redirect(route('admin-lesson-index'));
    }
}
