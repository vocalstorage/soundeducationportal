<?php

namespace App\Http\Controllers\teacher;

use Illuminate\Http\Request;
use App\LessonDate;
use App\Teacher;
use App\Lesson;
use App\Student;
use App\LessonDateRegistration;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class TeacherLessonDateController extends Controller
{
    public function create($date, $lesson_id)
    {
        $teacher = teacher::find(Auth::id());


        $timesArray = LessonDate::where('date', $date . ' 00:00:00')
            ->where('lesson_id', $lesson_id)
            ->where('teacher_id', $teacher->id)
            ->get()->pluck('time');
        $timesArray = $timesArray->toArray();
        $teacher->setAttribute('times', $timesArray);
        $i = 1;
        $times = "";

        while ($i <= 24) {
            $number = $i / 6;
            $firstNumber = 0;
            $css = '';
            $style = '';
            if ($i > 9) {
                $firstNumber = "";
            }
            $time = $firstNumber . $i . ':00';
            if (in_array($time, $timesArray)) {
                $css = ' selected_time';
                $style = 'background-color: ' . $teacher->color . '';
            }

            if (floor($number) == $number) {
                $times .= '<td><span style="' . $style . '" class="time' . $css . '">' . $time . '</span></td>';
                $times .= '</tr>';
                $times .= '<tr>';
            } else {
                $times .= '<td ><span style="' . $style . '" class="time' . $css . '">' . $time . '</span></td>';
            }
            $i++;
        }
        $teacher->setAttribute('timesHtml', $times);
        $teacher->setAttribute('removedTimes', []);



        $data = [
            'teacher' => $teacher,
            'times' => $times,
        ];

        return view('teacher.lessonDate.create', $data);
    }

    public function store(Request $request)
    {

        $lesson = Lesson::find($request->request->get('lesson_id'));
        $teacherJson = $request->request->get('teacher');


        if (!empty($teacherJson['times'])) {
            $times = $teacherJson['times'];

            foreach ($times as $time) {
                $lessonDateId = $lesson->lessonDates()->updateOrCreate([
                    'date' => date('Y-m-d', strtotime($request->request->get('date'))),
                    'time' => $time,
                    'teacher_id' => $teacherJson['id'],
                    'registrations' => '0',
                ])->id;

                $lessonDate = LessonDate::find($lessonDateId);
                Teacher::find($teacherJson['id'])->lesson_dates()->save($lessonDate);
            }
        }

        if (!empty($teacherJson['removedTimes'])) {
            $times = $teacherJson['removedTimes'];

            foreach ($times as $time) {
                LessonDate::where('time', '=', $time)
                    ->where('lesson_id', '=', $lesson->id)
                    ->where('teacher_id','=', $teacherJson['id'])
                    ->delete();
            }
        }

        return response()->json(array(['succes', 'succes']),
            200);
    }

    public function showRegistrationForm($id)
    {
        $lessonDate = LessonDate::find($id);

        $registratedStudents = LessonDateRegistration::where('lesson_date_id', '=', $id)->get();

        $students = Student::whereNotIn('id', $registratedStudents)->get();

        $data = [
            'lessonDate' => $lessonDate,
            'students' => $students,
        ];

        return view('teacher.lessonDate.registrationForm', $data);
    }


}
