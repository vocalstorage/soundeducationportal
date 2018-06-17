<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Student;

class AdminStudentController extends Controller
{
    public function delete($id){

        $student = Student::find($id);
        $student->delete();


        return response()->json(array(['succes', 'succes']),
            200);
    }
}
