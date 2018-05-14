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
        $lessons = Lesson::paginate(10);
        $view = 'index';


        $lastDate = "empty";
        $data = [
            'lessons' => $lessons,
            'lastDate' => $lastDate,
            'view' => $view,
        ];

        return view('admin.lesson.index', $data);
    }

    public function show($id){
        $lesson = Lesson::find($id);

        $max = $lesson->max;
        $events = [];


        foreach ($lesson->lessonDates as $lessonDate){
            if($lessonDate->time === '24:00'){
                $lessonDate->time = '23:59';
            }

            $event = [
                'start' =>  date('Y-m-d',strtotime($lessonDate->date)).'T'.$lessonDate->time,
                'lessonDate_id' => $lessonDate->id,
                'title' => $lessonDate->teacher->name . '(' . $lessonDate->lessonDateRegistrations->count() . ')',
                'backgroundColor' => $lessonDate->teacher->color,
                'borderColor' => $lessonDate->teacher->color,
                'teacher_id' => $lessonDate->teacher->id,
            ];

            if($lessonDate->registrations >= $max){
                array_push($event, $event['status'] = 'full');
            }else{
                array_push($event, $event['status'] = 'open');
            }
            array_push($events, $event);
        }
        $data = [
            'lesson_id' => $id,
            'events' => $events,
        ];

        return view('admin.lesson.show', $data);
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
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'max_registration' => 'required',
            'deadline' => 'required',
        ]);

        $lesson = Lesson::create([
                'title' => $request->request->get('title'),
                'description' => $request->request->get('description'),
                'deadline' => $request->request->get('deadline'),
                'max_registration' => $request->request->get('max_registration'),
            ]
        );

        return redirect(route('admin-lesson-show', $lesson->id));
    }

    public function edit($id){
        $lesson = Lesson::find($id);


        $data = [
            'lesson' => $lesson
        ];

        $html = view('admin.lesson.edit', $data)->render();
        return $html;
    }

    public function update(Request $request, $id){
        $lesson = Lesson::find($id);

        $lesson->update($request->request->all());

        return redirect(route('admin-lesson-index'));
    }

    public function delete($id){
        Lesson::find($id)->delete();
    }


}
