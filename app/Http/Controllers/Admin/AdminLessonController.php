<?php

namespace App\Http\Controllers\Admin;

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
        $lessons = Lesson::where('deadline', '>', Carbon::today())
            ->orderBy('deadline', 'asc')->paginate(10);

        $teacherStudioRelations = Teacher::whereHas('studio')->get()->count();

        $data = [
            'lessons' => $lessons,
            'teacherStudioRelations' => $teacherStudioRelations,
        ];

        return view('admin.lesson.index', $data);
    }

    public function show($id)
    {
        $lesson = Lesson::find($id);

        $lesson->checkEmptyDates();

        $max = $lesson->max;
        $events = [];


        foreach ($lesson->lessonDates as $lessonDate) {
            if ($lessonDate->time === '24:00') {
                $lessonDate->time = '23:59';
            }

            $event = [
                'start' => date('Y-m-d', strtotime($lessonDate->date)) . 'T' . $lessonDate->time,
                'lessonDate_id' => $lessonDate->id,
                'title' => '(' . $lessonDate->lessonDateRegistrations->count() . ')',
                'backgroundColor' => $lessonDate->teacher->color,
                'borderColor' => $lessonDate->teacher->color,
                'teacher_id' => $lessonDate->teacher->id,
            ];

            if($lessonDate->warning === 1 && $lessonDate->registrations <= 2){
                $event['className'] = ['pulse','yellow-text'];
            }


            if ($lessonDate->registrations >= $max) {
                array_push($event, $event['status'] = 'full');
            } else {
                array_push($event, $event['status'] = 'open');
            }
            array_push($events, $event);
        }

        $event_regs = [];

        foreach ($lesson->lessonDates as $lessonDate) {
            foreach ($lessonDate->lessonDateRegistrations as $registration) {
                if ($lessonDate->time === '24:00') {
                    $lessonDate->time = '23:59';
                }
                $event_reg = [
                    'start' => date('Y-m-d', strtotime($lessonDate->date)) . 'T' . $lessonDate->time,
                    'lessonDate_id' => $lessonDate->id,
                    'title' => $registration->student->name,
                    'backgroundColor' => $lessonDate->teacher->color,
                    'borderColor' => $lessonDate->teacher->color,
                    'presence' => true,
                ];

                if ($lessonDate->registrations >= $max) {
                    array_push($event_regs, $event_reg['status'] = 'full');
                } else {
                    array_push($event_regs, $event_reg['status'] = 'open');
                }
                array_push($event_regs, $event_reg);
            }
        }


        $data = [
            'lesson' => $lesson,
            'events' => $events,
            'event_regs' => $event_regs,
        ];

        return view('admin.lesson.show', $data);
    }

    public function showWarning($id)
    {
        $lesson = Lesson::find($id);

        $max = $lesson->max;
        $events = [];

        foreach ($lesson->checkEmptyDates() as $lessonDate) {
            if ($lessonDate->time === '24:00') {
                $lessonDate->time = '23:59';
            }

            $event = [
                'start' => date('Y-m-d', strtotime($lessonDate->date)) . 'T' . $lessonDate->time,
                'lessonDate_id' => $lessonDate->id,
                'title' => $lessonDate->teacher->name . '(' . $lessonDate->lessonDateRegistrations->count() . ')',
                'backgroundColor' => '#ffee58',
                'borderColor' => '#ffee58',
                'teacher_id' => $lessonDate->teacher->id,
            ];
            array_push($event, $event['status'] = 'open');
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

        $teachers = Teacher::whereHas('studio')->get();
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
            'description' => 'required|min:20',
            'max_registration' => 'required|integer',
            'deadline' => 'required|date_format:d/m/Y|after:today',
            'filepath' => 'required',
            'schoolgroup_id' => 'required|integer',
            'teachers' => 'required',
        ]);

        $path = $request->request->get('filepath');
        $filepath = Filepath::where('path', $path)->first();

        if (empty($filepath)) {
            $filepath = Filepath::create([
                'path' => $path
            ]);
        }

        $request['deadline'] = Carbon::createFromFormat('d/m/Y', $request->request->get('deadline'));
        $request['filepath_id'] = $filepath->id;

        $lesson = Lesson::create($request->request->all());
        $lesson->teachers()->sync($request->request->get('teachers'));
        return redirect(route('admin-lesson-show', $lesson->id));
    }

    public function edit($id)
    {
        $lesson = Lesson::find($id);
        $teachers = Teacher::all();

        $data = [
            'lesson' => $lesson,
            'teachers' => $teachers,
        ];

        $html = view('admin.lesson.edit', $data)->render();
        return $html;
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required|min:20',
            'max_registration' => 'required|integer',
            'deadline' => 'required|date_format:d/m/Y|after:today',
            'filepath' => 'required',
            'schoolgroup_id' => 'required|integer',
            'teachers' => 'required',
        ]);

        $lesson = Lesson::find($id);


        $path = $request->request->get('filepath');
        $filepath = Filepath::where('path', $path)->first();

        if (empty($filepath)) {
            $filepath = Filepath::create([
                'path' => $path
            ]);
        }

        $request->except('filepath');
        $request['deadline'] = Carbon::createFromFormat('d/m/Y', $request->request->get('deadline'));
        $request['filepath_id'] = $filepath->id;


        $lesson->update($request->request->all());
        $lesson->teachers()->sync($request->request->get('teachers'));


        return redirect(route('admin-lesson-index'));
    }

    public function delete(Request $request, $id)
    {
        if($request->ajax()) {
            $lesson = Lesson::find($id);
            $lesson->lessonDates()->delete();
            $lesson->delete();
        }

        return redirect(route('admin-lesson-index'));
    }

    public function presence($id)
    {
        $lesson = Lesson::find($id);

        $max = $lesson->max;
        $events = [];

        foreach ($lesson->lessonDates as $lessonDate) {
            if (count($lessonDate->lessonDateRegistrations) > 0) {
                $registrations = [];
                foreach ($lessonDate->lessonDateRegistrations as $registration) {
                    $registrationJson['id'] = $registration->id;
                    $registrationJson['student'] = $registration->student->name;
                    $registrationJson['presence'] = $registration->presence;

                    if (!empty($registration->comment)) {
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
                    $event['status'] = 'full';
                } else {
                     $event['status'] = 'open';
                }
                array_push($events, $event);
            }
        }

        $data = [
            'events' => $events,
            'lesson' => $lesson,
        ];


            return view('admin.lesson.presence', $data);
        }
    }
