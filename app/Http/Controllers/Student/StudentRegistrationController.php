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

class StudentRegistrationController extends Controller
{
    public function show($lessonDate_id){

        $lessonDate = LessonDate::find($lessonDate_id);

        $data = [
            'lessonDate' => $lessonDate,
        ];

        return view('student.lessonDate.registrationForm', $data);

    }

    public function store(Request $request)
    {
        $lessonDate = LessonDate::find($request->get('lessonDate_id'));

        foreach(\Auth::user()->lessonDateRegistrations as $lessonDateRegistration){
            $id = $lessonDateRegistration->lessonDate->lesson->id;
            if($id == $lessonDate->lesson->id){
                return response()->json(array(['false', 'false']), 500);
            }
        }

        if($lessonDate->registrations < $lessonDate->lesson->max_registration){
            LessonDateRegistration::create([
                'lesson_id' => $lessonDate->lesson->id,
                'lesson_date_id' => $request->input('lessonDate_id'),
                'student_id' => \Auth::user()->id,
                'skill' => $request->get('skill'),
            ]);
            $lessonDate->increment('registrations');
        }
        Mail::to(\Auth::user())->send(new LessondateScheduled($lessonDate));

        return response()->json(array(['succes', 'succes']), 200);
    }

    public function delete($id)
    {
        $registration = LessonDateRegistration::where('id', '=' ,$id)
        ->where('student_id', '=', \Auth::user()->id)->get()->first();

        if(is_integer($registration->mayCancel()) && $registration->mayCancel() !== 3){
            $registration->lessonDate->decrement('registrations');
            $registration->delete();
        }

        return redirect(route('student-appointments'));
    }

    public function update(Request $request, $id){
        $lessonDateRegistration = LessonDateRegistration::find($id);

        $request->validate([
            'comment' => 'required|min:5',
        ]);

        $lessonDateRegistration->update(['comment' => $request->request->get('comment')]);

        return redirect(route('student-appointments'));
    }
}
