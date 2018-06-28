<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Student;
use Illuminate\Http\Request;


class AdminStudentController extends Controller
{
    public function delete(Request $request, $id){
        if($request->ajax()) {
            $student = Student::find($id);
            $student->delete();
        }

        return response()->json(array(['succes', 'succes']), 200);
    }
}
