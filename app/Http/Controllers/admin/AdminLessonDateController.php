<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\LessonDate;
use App\Teacher;
use App\Lesson;
use App\Http\Controllers\Controller;

class AdminLessonDateController extends Controller
{
    //
    public function create(){
        $teachers = teacher::all();

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

        //$lesson = Lesson::find($lesson_id);

        $data = [
            'teachers' => $teachers,
            'times' => $times,
        ];

        return view('admin.lesson_date.create', $data);
    }

    public function store(Request $request){
        $lesson = Lesson::find($request->request->get('lesson_id'));
        $times = $request->request->get('times');
        $teacher_id = $request->request->get('teacher_id');
        $teacher = Teacher::find($teacher_id);

        foreach($times as $time){
            $lessonDateId = $lesson->lessonDates()->create([
                'date' =>   date('Y-m-d',strtotime($request->request->get('date'))),
                'deadline' => '0',
                'time' => $time,
                'teacher_id' => $teacher_id,
                'registrations' => '0',
            ])->id;

            $lessonDate = LessonDate::find($lessonDateId);
            $teacher->lessons()->save($lessonDate);
        }

        return response()->json(array(['succes', 'succes']),
            200);

    }

    public function edit(Request $request)
    {
        $lesson_date = LessonDate::findOrFail($request->request->get('lesson_date_id'));
        $timesArray = LessonDate::where('date', $lesson_date->date)
                        ->where('lesson_id', $lesson_date->lesson_id)
                        ->get()->pluck('time');
        $teacher = Teacher::findOrFail($lesson_date->teacher_id);

        $view = 'edit';

        $i = 1;
        $times = "";
        while ($i <= 24) {
            $css = "";
            $number = $i / 6;
            $firstNumber = 0;
            if ($i > 9) {
                $firstNumber = "";
            }

            if($lesson_date->time == $firstNumber.$i.':00'){
                $css = 'style="background-color: rgb(20, 20, 80); color: rgb(255, 255, 255)"';
            }else if(strpos($timesArray,$firstNumber.$i.':00' )){
                $css = 'style="background-color: rgb(76, 175, 80); color: rgb(255, 255, 255)"';
            }
            if (floor($number) == $number) {
                $times .= '<td><span class="time span_edit" '.$css.'>'. $firstNumber . $i .  ':00</span></td>';
                $times .= '</tr>';
                $times .='<tr>';
            }else {
                $times .='<td ><span class="time span_edit" '.$css.'>' . $firstNumber . $i . ':00</span></td>';
            }
            $i++;
        }

        $data = [
            'lesson_date' => $lesson_date,
            'teacher' => $teacher,
            'times' => $times,
            'view' => $view,
        ];

        $html = view('admin.layouts.lessonDateForm', $data)->render();

       return response()->json(array([
           'html'=> $html,
           'times' => $timesArray,
           'lesson_date_edit_id' => $request->request->get('lesson_date_id')]),
           200);
    }




    public function update(Request $request){
        $times_edit_added = "";
        $times_edit_removed = "";
        $lesson_date = LessonDate::findOrFail($request->request->get('lesson_date_id'));
        $lesson = Lesson::findOrFail($lesson_date->lesson_id);
        $teacher_id = $request->request->get('teacher_id');
        $teacher = Teacher::findOrFail($teacher_id);

        $times_edit_added = $request->request->get('times_edit_added');
        if($times_edit_added){
            foreach($times_edit_added as $time){
                $lessonDateId = $lesson->lessonDates()->create([
                    'date' =>   date('Y-m-d',strtotime($lesson_date->date)),
                    'deadline' => $lesson_date->deadline,
                    'time' => $time,
                    'teacher_id' => $lesson_date->teacher_id,
                    'registrations' => '0',
                ])->id;

                $lessonDate = LessonDate::find($lessonDateId);
                $teacher->lessons()->save($lessonDate);
            }
        }


        $times_edit_removed = $request->request->get('times_edit_removed');
        if($times_edit_removed){
            foreach($times_edit_removed as $time){
                LessonDate::where('lesson_id', $lesson_date->lesson_id)
                    ->where('date', $lesson_date->date)
                    ->where('teacher_id', $teacher_id)
                    ->where('time', $time)
                    ->delete();
            }
        }


        return response()->json(array(['succes', $request ]),
            200);
    }

    public function delete($id){
        $lessonDate = LessonDate::find($id);
        $lessonDate->delete();

        return redirect(route('admin-lesson-index'));
    }
}
