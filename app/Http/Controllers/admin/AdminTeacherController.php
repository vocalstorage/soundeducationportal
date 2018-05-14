<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\teacher;
use App\studio;

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
            'color' => 'required',
        ]);

        Teacher::create($request->request->all());

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
        $teacher = Teacher::find($id);


        $teacher->update($request->request->all());

        return redirect(route('admin-teacher-index'));
    }

    public function delete($id){
        Teacher::find($id)->delete();
    }
}
