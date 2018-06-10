<?php

namespace App\Http\Controllers\Teacher;

use App\LessonDate;
use Illuminate\Http\Request;
use App\Teacher;
use App\Lesson;
use App\Filepath;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TeacherLessonController extends Controller
{
    public function index()
    {
        $lessons = \Auth::user()->lessons()->paginate(10);

        $data = [
            'lessons' => $lessons,
        ];

        return view('teacher.lesson.index', $data);
    }

    public function show($id)
    {
        $lesson = Lesson::find($id);

        $max = $lesson->max;
        $events = [];

        foreach ($lesson->lessonDates as $lessonDate) {
            if($lessonDate->teacher->id == Auth::id()){
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
        }
        $data = [
            'lesson_id' => $id,
            'events' => $events,
            'deadline' => $lesson->deadline,
        ];

        return view('teacher.lesson.show', $data);
    }
}
