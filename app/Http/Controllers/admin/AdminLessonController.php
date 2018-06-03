<?php

namespace App\Http\Controllers\admin;

use App\LessonDate;
use Illuminate\Http\Request;
use App\Teacher;
use App\Lesson;
use App\Filepath;
use Carbon\Carbon;
use App\Http\Controllers\Controller;

class AdminLessonController extends Controller
{
    public function index()
    {
        $lessons = Lesson::with('lessonDates')->paginate(10);

        foreach ($lessons as $lesson){
            $amount = $lesson->removeLessonDates();
            if($amount> 0){
                $lesson['removedlessondates'] = $amount;
            }
        }

        $lastDate = "empty";
        $data = [
            'lessons' => $lessons,
            'lastDate' => $lastDate,
        ];

        return view('admin.lesson.index', $data);
    }

    public function show($id)
    {
        $lesson = Lesson::find($id);

        $max = $lesson->max;
        $events = [];


        foreach ($lesson->lessonDates as $lessonDate) {
            if ($lessonDate->time === '24:00') {
                $lessonDate->time = '23:59';
            }

            $event = [
                'start' => date('Y-m-d', strtotime($lessonDate->date)) . 'T' . $lessonDate->time,
                'lessonDate_id' => $lessonDate->id,
                'title' => $lessonDate->teacher->name . '(' . $lessonDate->lessonDateRegistrations->count() . ')',
                'backgroundColor' => $lessonDate->teacher->color,
                'borderColor' => $lessonDate->teacher->color,
                'teacher_id' => $lessonDate->teacher->id,
            ];

            if ($lessonDate->registrations >= $max) {
                array_push($event, $event['status'] = 'full');
            } else {
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

    public function create()
    {

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
                $times .= '<td><span class="time">' . $firstNumber . $i . ':00</span></td>';
                $times .= '</tr>';
                $times .= '<tr>';
            } else {
                $times .= '<td ><span class="time">' . $firstNumber . $i . ':00</span></td>';
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

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'max_registration' => 'required|integer',
            'deadline' => 'required|date_format:d/m/Y|after:today',
            'filepath' => 'required',
        ]);
        $filepath_id = Filepath::where('path', $request->request->get('filepath'))->first()->id;
        $request['deadline'] = Carbon::createFromFormat('d/m/Y', $request->request->get('deadline'));


        $request->except('filepath');

        $lesson = Lesson::create(array_merge($request->request->all(), ['filepath_id' => $filepath_id]));

        return redirect(route('admin-lesson-show', $lesson->id));
    }

    public function edit($id)
    {
        $lesson = Lesson::find($id);


        $data = [
            'lesson' => $lesson
        ];

        $html = view('admin.lesson.edit', $data)->render();
        return $html;
    }

    public function update(Request $request, $id)
    {
        $lesson = Lesson::find($id);

        $filepath_id = Filepath::where('path', $request->request->get('filepath'))->first()->id;
        $request->except('filepath');

        $request['deadline'] = $request->request->get('deadline');


        $lesson->update(array_merge($request->request->all(), ['filepath_id' => $filepath_id]));

        return redirect(route('admin-lesson-index'));
    }

    public function delete($id)
    {

        $lesson = Lesson::find($id);

        $lesson->lessonDates()->delete();
        $lesson->lessonDates()->delete();

    }


}
