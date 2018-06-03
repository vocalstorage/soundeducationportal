<?php

namespace App\Http\Controllers\admin;

use App\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Webpatser\Uuid;
use App\Mail\StudentSendPassword;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;


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

    public function create(){
        return view('admin.student.create');
    }

    public function store(Request $request){
        $path = substr($request->request->get('filepath'), 1);
        $class = $request->request->get('class');

        Excel::load($path, function($reader) {
            $results = $reader->all();
            foreach ($results as $result){
                $password = Uuid\Uuid::generate()->string;
                if(!empty($result->naam && !empty($result->email))){
                    $student = Student::create([
                        'name' => $result->naam,
                        'email' => $result->email,
                        'password' =>  Hash::make($password)
                    ]);

                    Mail::to($student)->send(new StudentSendPassword($student,$password));
                }
            }
        });
    }

    public function delete($id){
        Student::find($id)->delete();
    }
}
