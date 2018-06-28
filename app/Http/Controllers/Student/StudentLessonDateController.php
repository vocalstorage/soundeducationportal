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
        if($lesson->maySchedule()) {
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
                    'start' => $lessonDate->date->format('Y-m-d'). 'T' . $lessonDate->time,
                    'lessonDate_id' => $lessonDate->id,
                    'title' => '('.$lessonDate->registrations.')',
                ];


                if ($lessonDate->registrations >= $max || $lessonDate->date->isPast()) {
                    $event['backgroundColor'] = 'grey';
                    $event['borderColor'] = 'grey';
                    $event['status'] = 'full';
                    $event['className'] = 'full';

                }else{
                     $event['status'] = 'open';
                     $event['backgroundColor'] = '66BB6A';
                     $event['borderColor'] = '66BB6A';
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
