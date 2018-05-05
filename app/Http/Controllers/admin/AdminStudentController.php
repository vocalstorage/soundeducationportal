<?php

namespace App\Http\Controllers\admin;

use App\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminStudentController extends Controller
{
    public function index()
    {
        $students = student::all();

        $data = [
            'students' => $students,
        ];

        return view('admin.student.index', $data);
    }
}
