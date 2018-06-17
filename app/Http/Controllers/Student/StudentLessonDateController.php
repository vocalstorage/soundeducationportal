<?php

namespace App\Http\Controllers\Student;

use App\LessonDate;
use App\Lesson;
use App\Mail\LessondateScheduled;
use App\Mail\LessondateCanceled;

use App\LessonDateRegistration;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class StudentLessonDateController extends Controller
{
    public function show($teacher_id,$lesson_id){
        $lesson = Lesson::find($lesson_id);
        if($lesson->diffDeadline() > 5) {
            foreach (\Auth::user()->lessonDateRegistrations as $lessonDateRegistration) {
                $id = $lessonDateRegistration->lessonDate->lesson->id;
                if ($id == $lesson_id) {
                    return back();
                }
            }

            $lessonDates = LessonDate::where('teacher_id', '=', $teacher_id)
                ->where('lesson_id', '=', $lesson_id)
                ->get();
            $max = $lesson->max_registration;
            $events = [];


            foreach ($lessonDates as $lessonDate) {

                $event = [
                    'start' => date('Y-m-d', strtotime($lessonDate->date)) . 'T' . $lessonDate->time,
                    'lessonDate_id' => $lessonDate->id,

                ];

                if ($lessonDate->registrations >= $max) {
                    array_push($event, $event['backgroundColor'] = 'grey');
                    array_push($event, $event['borderColor'] = 'grey');
                    array_push($event, $event['status'] = 'full');
                }else{
                    array_push($event, $event['status'] = 'open');
                    array_push($event, $event['backgroundColor'] = '66BB6A');
                    array_push($event, $event['borderColor'] = '66BB6A');
                }
                array_push($events, $event);
            }

            $data = [
                'events' => $events,
            ];

            return view('student.lessonDate.show', $data);
        }else{
            return back();
        }
    }
}
