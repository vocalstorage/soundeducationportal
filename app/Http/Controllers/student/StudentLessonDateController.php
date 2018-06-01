<?php

namespace App\Http\Controllers\student;

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
                } else {
                    array_push($event, $event['status'] = 'open');
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

    public function showRegistrationForm($lessonDate_id){

        $lessonDate = LessonDate::find($lessonDate_id);

        $data = [
            'lessonDate' => $lessonDate,
        ];

        return view('student.lessonDate.registrationForm', $data);

    }

    public function postRegistrationForm(Request $request)
    {
        $lessonDate = LessonDate::find($request->get('lessonDate_id'));
        Mail::to(\Auth::user())->send(new LessondateScheduled($lessonDate));

        foreach(\Auth::user()->lessonDateRegistrations as $lessonDateRegistration){
            $id = $lessonDateRegistration->lessonDate->lesson->id;
            if($id == $lessonDate->lesson->id){
                return response()->json(array(['false', 'false']), 500);
            }
        }

        if($lessonDate->registrations < $lessonDate->lesson->max_registration){
            LessonDateRegistration::create([
                'lesson_date_id' => $request->input('lessonDate_id'),
                'student_id' => \Auth::user()->id,
                'skill' => $request->get('skill'),
            ]);
            $lessonDate->increment('registrations');
        }


        return response()->json(array(['succes', 'succes']), 200);
    }

    public function delete($id)
    {
        $registration = LessonDateRegistration::find($id);
        $registration->lessonDate->decrement('registrations');
        $registration->delete();

        return redirect(route('student-appointments'));
    }
}
