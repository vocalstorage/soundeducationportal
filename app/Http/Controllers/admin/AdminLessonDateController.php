<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\LessonDate;
use App\Teacher;
use App\Lesson;
use App\Student;
use App\LessonDateRegistration;
use App\Http\Controllers\Controller;

class AdminLessonDateController extends Controller
{
    //
    public function create($date, $lesson_id)
    {
        $teachers = teacher::all();

        foreach ($teachers as $teacher) {

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
                    $style = 'background-color: '.$teacher->color.'';
                }

                if (floor($number) == $number) {
                    $times .= '<td><span style="'.$style.'" class="time' . $css . '">' . $time . '</span></td>';
                    $times .= '</tr>';
                    $times .= '<tr>';
                } else {
                    $times .= '<td ><span style="'.$style.'" class="time' . $css . '">' . $time . '</span></td>';
                }
                $i++;
            }
            $teacher->setAttribute('timesHtml', $times);
            $teacher->setAttribute('removedTimes', []);
        }

        $data = [
            'teachers' => $teachers,
            'times' => $times,
        ];

        return view('admin.lessonDate.create', $data);
    }

    public function store(Request $request)
    {
        $lesson = Lesson::find($request->request->get('lesson_id'));
        $teachers = collect($request->request->get('teachers'));

        foreach ($teachers as $teacherJson) {
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
        }

        return response()->json(array(['succes', 'succes']),
            200);

    }

    public function edit(Request $request)
    {
        $lesson_date = LessonDate::findOrFail($request->request->get('lesson_date_id'));
        $timesArray = LessonDate::where('date', $lesson_date->date)
            ->where('lesson_id', $lesson_date->lesson_id)
            ->get()->pluck('time');
        $teacher = Teacher::findOrFail($lesson_date->teacher_id);

        $view = 'edit';

        $i = 1;
        $times = "";
        while ($i <= 24) {
            $css = "";
            $number = $i / 6;
            $firstNumber = 0;
            if ($i > 9) {
                $firstNumber = "";
            }

            if ($lesson_date->time == $firstNumber . $i . ':00') {
                $css = 'style="background-color: rgb(20, 20, 80); color: rgb(255, 255, 255)"';
            } else if (strpos($timesArray, $firstNumber . $i . ':00')) {
                $css = 'style="background-color: rgb(76, 175, 80); color: rgb(255, 255, 255)"';
            }
            if (floor($number) == $number) {
                $times .= '<td><span class="time span_edit" ' . $css . '>' . $firstNumber . $i . ':00</span></td>';
                $times .= '</tr>';
                $times .= '<tr>';
            } else {
                $times .= '<td ><span class="time span_edit" ' . $css . '>' . $firstNumber . $i . ':00</span></td>';
            }
            $i++;
        }

        $data = [
            'lesson_date' => $lesson_date,
            'teacher' => $teacher,
            'times' => $times,
            'view' => $view,
        ];

        $html = view('admin.layouts.lessonDateForm', $data)->render();

        return response()->json(array([
            'html' => $html,
            'times' => $timesArray,
            'lesson_date_edit_id' => $request->request->get('lesson_date_id')]),
            200);
    }


    public function update(Request $request)
    {
        $times_edit_added = "";
        $times_edit_removed = "";
        $lesson_date = LessonDate::findOrFail($request->request->get('lesson_date_id'));
        $lesson = Lesson::findOrFail($lesson_date->lesson_id);
        $teacher_id = $request->request->get('teacher_id');
        $teacher = Teacher::findOrFail($teacher_id);

        $times_edit_added = $request->request->get('times_edit_added');
        if ($times_edit_added) {
            foreach ($times_edit_added as $time) {
                $lessonDateId = $lesson->lessonDates()->create([
                    'date' => date('Y-m-d', strtotime($lesson_date->date)),
                    'deadline' => $lesson_date->deadline,
                    'time' => $time,
                    'teacher_id' => $lesson_date->teacher_id,
                    'registrations' => '0',
                ])->id;

                $lessonDate = LessonDate::find($lessonDateId);
                $teacher->lessons()->save($lessonDate);
            }
        }


        $times_edit_removed = $request->request->get('times_edit_removed');
        if ($times_edit_removed) {
            foreach ($times_edit_removed as $time) {
                LessonDate::where('lesson_id', $lesson_date->lesson_id)
                    ->where('date', $lesson_date->date)
                    ->where('teacher_id', $teacher_id)
                    ->where('time', $time)
                    ->delete();
            }
        }


        return response()->json(array(['succes', $request]),
            200);
    }

    public function delete($id)
    {
        $lessonDate = LessonDate::find($id);
        $lessonDate->delete();
    }

    public function registerStudent($id, $student_id){
        $lessonDate = LessonDate::find($id);

        LessonDateRegistration::create([
            'lesson_date_id' => $id,
            'student_id' => $student_id,
            'skill' => 'none',
        ]);

        $lessonDate->increment('registrations');

        return back();
    }

    public function cancelStudent($id, $registration_id){
        LessonDate::find($id)->decrement('registrations');
        LessonDateRegistration::find($registration_id)->delete();
    }

    public function showRegistrationForm($id)
    {
        $lessonDate = LessonDate::find($id);

        $registratedStudents =  LessonDateRegistration::where('lesson_date_id', '=', $id)->get();

        $students = Student::whereNotIn('id', $registratedStudents)->get();

        $data = [
            'lessonDate' => $lessonDate,
            'students' => $students,
        ];

        return view('admin.lessonDate.registrationForm', $data);
    }


}
