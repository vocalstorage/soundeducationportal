<?php

namespace App\Http\Controllers\admin;

use App\LessonDate;
use Illuminate\Http\Request;
use App\Teacher;
use App\Lesson;
use Carbon\Carbon;
use App\Http\Controllers\Controller;

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

//        $lessondates = Lesson::find('1')->lessondates;
//
//        $events = [];
//
////        foreach($lessondates as $lessonDate){
////            $event = [
////                'start' =>   date('Y-m-d',strtotime($lessonDate->date)).'T'.$lessonDate->time,
////                'lessonDate_id' => $lessonDate->id,
////                'teacher_id' => $lessonDate->teacher->id,
////            ];
////            array_push($events, $event);
////        }
////
////        dd($events);


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

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'max_registration' => 'required',
            'deadline' => 'required',
            'dates' => 'required',
        ]);

        $lesson = Lesson::create([
                'title' => $request->request->get('title'),
                'description' => $request->request->get('description'),
                'deadline' => $request->request->get('deadline'),
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
                    'time' => $time,
                    'teacher_id' => $lessonDate->teacher_id,
                    'registrations' => '0',
                ])->id;

                //link teacher
                $lessonDate = LessonDate::find($lessonDateId);
                $teacher->lesson_dates()->save($lessonDate);
            }
        }

        return redirect(route('admin-lesson-index'));
    }

    public function edit($id){
        $lesson = Lesson::find($id);


        $data = [
            'lesson' => $lesson
        ];

        $html = view('admin.lesson.edit', $data)->render();
        return $html;
    }

    public function update(Request $request){
        $request = $request->get('request');

        $lesson = Lesson::find($request['lesson_id']);

        $result = $lesson->update($request);


        return response()->json(array([
            'succes'=> $result,
            200]));
    }

    public function delete($id){
        $lesson= Lesson::find($id);
        $lesson->delete();

        return redirect(route('admin-lesson-index'));
    }


}
