<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\LessonDate;
use App\LessonDateRegistration;
use App\Mail\LessondateScheduled;
use App\Rules\MayComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class StudentRegistrationController extends Controller
{
    public function show(Request $request, $lessonDate_id)
    {
        if ($request->ajax()) {
            $lessonDate = LessonDate::find($lessonDate_id);

            $data = [
                'lessonDate' => $lessonDate,
            ];

            return view('student.lessonDate.registrationForm', $data);
        }
        return back();
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {
            $request->validate([
                'lesson_date_id' => 'required|int',
                'skill' => 'required|int',
            ]);

            if ($request->get('skill') <= 3 && $request->get('skill') >= 1) {
                $skills = [
                    'Beginner',
                    'Gemiddeld',
                    'Gevorderd',
                ];

                $lessonDate = LessonDate::find($request->get('lesson_date_id'));

                if ($lessonDate->lesson->maySchedule()) {
                    //check if student may register
                    foreach (\Auth::user()->lessonDateRegistrations as $lessonDateRegistration) {
                        $id = $lessonDateRegistration->lessonDate->lesson->id;
                        if ($id == $lessonDate->lesson->id) {
                            $error['message'] = 'Al geregistreerd';
                            return response()->json(['errors' => $error], 404);
                        }
                    }


                    //check if max is not reached
                    if ($lessonDate->registrations < $lessonDate->lesson->max_registration && !$lessonDate->lesson->deadline->isPast() && !$lessonDate->date->isPast()) {
                        $lessonDateRegistration = LessonDateRegistration::create([
                            'lesson_id' => $lessonDate->lesson->id,
                            'lesson_date_id' => $request->input('lesson_date_id'),
                            'student_id' => \Auth::user()->id,
                            'skill' => $skills[$request->get('skill') - 1],
                        ]);
                        if (!$lessonDateRegistration) {
                            $error['message'] = 'Registratie is verkeerd gegaan';
                            return response()->json($error, 404);
                        }
                        $lessonDate->increment('registrations');
                    } else {
                        $error['message'] = 'Max registraties bereikt of lesdatum is verleden';
                        return response()->json(['errors' => $error], 404);
                    }

                    Mail::to(\Auth::user())->send(new LessondateScheduled($lessonDate));
                } else {
                    $error['message'] = 'Deadline behaald, registreren is niet meer mogelijk!';
                    return response()->json(['errors' => $error], 404);
                }

            } else {
                $error['message'] = 'Er is iets fout gegaan!';
                return response()->json(['errors' => $error], 404);
            }
        }

        return response()->json(array(['succes', 'succes']), 200);
    }

    public function delete(Request $request, $id)
    {
        if ($request->ajax()) {
            $registration = LessonDateRegistration::where('id', '=', $id)->where('student_id', '=', \Auth::user()->id)->get()->first();


            if ($registration->mayCancel()) {
                $registration->lessonDate->decrement('registrations');
                $registration->delete();
            }
        }
        return redirect(route('student-appointments'));
    }

    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), [
            'comment' => ['required', 'min:5', new MayComment($id)],
        ]);

        if ($validator->fails()) {
            Session::put('lessonDateRegistrationId', $id);

            return redirect(route('student-appointments'))
                ->withErrors($validator)
                ->withInput();
        }

        $lessonDateRegistration = LessonDateRegistration::where('id', '=', $id)->where('student_id', '=', \Auth::user()->id)->get()->first();

        $lessonDateRegistration->update(['comment' => $request->request->get('comment')]);

        return redirect(route('student-appointments'));
    }
}
