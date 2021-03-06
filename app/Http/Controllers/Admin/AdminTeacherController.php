<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\TeacherSendPassword;
use Webpatser\Uuid;
use App\Teacher;

class AdminTeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::all();

        $data = [
            'teachers' => $teachers
        ];

        return view('admin.teacher.index', $data);
    }

    public function create()
    {

        return view('admin.teacher.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:teachers',
            'color' => 'required|unique:teachers',
        ]);

        $password = Uuid\Uuid::generate()->string;

        $teacher = Teacher::create(array_merge($request->request->all(),['password' => Hash::make($password)]));

        Mail::to($teacher)->send(new TeacherSendPassword($teacher,$password));

        return redirect(route('admin-studio-create'));
    }

    public function edit($id)
    {
        $teacher = Teacher::find($id);
        $teachers = Teacher::all();

        $data = [
            'teacher' => $teacher,
            'teachers' => $teachers,
        ];

        return view('admin.teacher.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:teachers,email,'.$id,
            'color' => 'required|unique:teachers,color,'.$id,
        ]);

        $teacher = Teacher::find($id);

        $teacher->update($request->request->all());

        return redirect(route('admin-teacher-index'));
    }

    public function delete(Request $request, $id){
        if($request->ajax()) {
            Teacher::find($id)->delete();
        }

        return redirect(route('admin-teacher-index'));
    }
}
