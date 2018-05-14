<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Studio;
use App\Teacher;

class AdminStudioController extends Controller
{
    public function index()
    {
        $studios = studio::all();

        $teacherNoRelation = Teacher::has('studio', '<', 1)->get()->count();

        $data = [
            'studios' => $studios,
            'teacherNoRelation' => $teacherNoRelation,
        ];

        return view('admin.studio.index', $data);
    }

    public function create()
    {
        $teachers = Teacher::has('studio', '<', 1)->get();

        $data = [
            'teachers' => $teachers
        ];

        return view('admin.studio.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'place' => 'required',
            'street' => 'required',
            'postal_code' => 'required',
        ]);

        Studio::create($request->request->all());

        return redirect(route('admin-studio-index'));
    }

    public function edit($id)
    {
        $studio = Studio::find($id);
        $teachers = Teacher::all();


        $data = [
            'studio' => $studio,
            'teachers' => $teachers,
        ];

        return view('admin.studio.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $studio = Studio::find($id);

        $studio->update($request->request->all());

        return redirect(route('admin-studio-index'));
    }

    public function delete($id){
        $studio = Studio::find($id);

        $studio->delete();

        return redirect(route('admin-studio-index'));
    }
}
