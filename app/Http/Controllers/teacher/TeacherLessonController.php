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
            if ($lessonDate->teacher->id == Auth::id()) {
                $event = [
                    'start' => date('Y-m-d', strtotime($lessonDate->date)) . 'T' . $lessonDate->time,
                    'lessonDate_id' => $lessonDate->id,
                    'title' => '(' . $lessonDate->lessonDateRegistrations->count() . ')',
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
        $event_regs = [];

        foreach ($lesson->lessonDates as $lessonDate) {
            if ($lessonDate->teacher->id == Auth::id()) {
                if (count($lessonDate->lessonDateRegistrations) > 0) {
                    $registrations = [];
                    foreach ($lessonDate->lessonDateRegistrations as $registration) {
                        $registrationJson['id'] = $registration->id;
                        $registrationJson['student'] = $registration->student->name;
                        $registrationJson['presence'] = $registration->presence;

                        if(!empty($registration->comment)){
                            $registrationJson['comment'] = $registration->comment;
                        }

                        array_push($registrations, $registrationJson);
                    }

                    $event = [
                        'start' => date('Y-m-d', strtotime($lessonDate->date)) . 'T' . $lessonDate->time,
                        'lessonDate_id' => $lessonDate->id,
                        'backgroundColor' => $lessonDate->teacher->color,
                        'borderColor' => $lessonDate->teacher->color,
                    ];

                    if (!empty($registrations)) {
                        $event['registrations'] = $registrations;
                    }

                    if ($lessonDate->registrations >= $max) {
                        array_push($event_regs, $event['status'] = 'full');
                    } else {
                        array_push($event_regs, $event['status'] = 'open');
                    }
                    array_push($event_regs, $event);
                }
            }
        }


        $data = [
            'lesson_id' => $id,
            'events' => $events,
            'event_regs' => $event_regs,
            'deadline' => $lesson->deadline,
        ];


        return view('teacher.lesson.show', $data);
    }

    public function presence($id)
    {
        $lesson = Lesson::find($id);

        $max = $lesson->max;
        $events = [];

        foreach ($lesson->lessonDates as $lessonDate) {
            if ($lessonDate->teacher->id == Auth::id()) {
                if (count($lessonDate->lessonDateRegistrations) > 0) {
                    if ($lessonDate->time === '24:00') {
                        $lessonDate->time = '23:59';
                    }
                    $registrations = [];

                    foreach ($lessonDate->lessonDateRegistrations as $registration) {
                        $registrationJson['id'] = $registration->id;
                        $registrationJson['student'] = $registration->student->name;
                        $registrationJson['presence'] = $registration->presence;
                        array_push($registrations, $registrationJson);
                    }

                    $event = [
                        'start' => date('Y-m-d', strtotime($lessonDate->date)) . 'T' . $lessonDate->time,
                        'lessonDate_id' => $lessonDate->id,
                        'title' => $lessonDate->teacher->name,
                        'backgroundColor' => $lessonDate->teacher->color,
                        'borderColor' => $lessonDate->teacher->color,
                        'presence' => true,
                    ];

                    if (!empty($registrations)) {
                        $event['registrations'] = $registrations;
                    }

                    if ($lessonDate->registrations >= $max) {
                        array_push($event, $event['status'] = 'full');
                    } else {
                        array_push($event, $event['status'] = 'open');
                    }
                    array_push($events, $event);
                }
            }
        }



        $data = [
            'lesson' => $lesson,
            'events' => $events,
            'deadline' => $lesson->deadline,
        ];


        return view('teacher.lesson.presence', $data);
    }
}
