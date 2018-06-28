<?php

namespace App\Http\Controllers\Admin;

use App\Schoolgroup;
use App\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use PhpParser\Node\Stmt\Global_;
use Webpatser\Uuid;
use App\Mail\StudentSendPassword;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;



class AdminSchoolgroupController extends Controller
{
    public function index()
    {
        $schoolgroups = Schoolgroup::all();

        $data = [
            'schoolgroups' => $schoolgroups,
        ];

        return view('admin.schoolgroup.index', $data);
    }

    public function create(){
        return view('admin.schoolgroup.create');
    }

    public function store(Request $request){

        $request->validate([
            'schoolgroup' => 'required',
            'filepath' => 'required',
        ]);

        $path = substr($request->request->get('filepath'), 1);

        $schoolgroup =  Schoolgroup::where('title', '=' , $request->request->get('schoolgroup'))->get()->first();

        if(!$schoolgroup){
            $schoolgroup =  Schoolgroup::create([
                'title' => $request->request->get('schoolgroup')
            ]);
        }

        $students = [];
        $failures = [];
         Excel::load($path, function($reader) use ($schoolgroup,  &$students, &$failures) {
            $results = $reader->all();
            foreach ($results as $result){
                $password = Uuid\Uuid::generate()->string;
                if(!empty($result->naam && !empty($result->email))){
                    try{
                        $student = Student::create([
                            'name' => $result->naam,
                            'email' => $result->email,
                            'schoolgroup_id' => $schoolgroup->id,
                            'password' =>  Hash::make($password),
                        ]);
                        Mail::to($student)->send(new StudentSendPassword($student,$password));
                        array_push($students, $result);
                    }catch (\Exception $e){
                        if($e->errorInfo[1] == 1062){
                            $result['err_message'] = 'dubbele invoer';
                        }else{
                            $result['err_message'] = json_encode($e->errorInfo).$result->email;
                        }
                        array_push($failures, $result);

                    }
                }else{
                    array_push($failures, $result);
                }
            }
         });


         $data = [
             'students' => $students,
             'failures' => $failures,
         ];

        return view('admin.schoolgroup.create', $data);
    }

    public function edit($id){
        $schoolgroup = Schoolgroup::find($id);

        $data = [
            'schoolgroup' => $schoolgroup
        ];

        return view('admin.schoolgroup.edit', $data);
    }

    public function update(Request $request, $id){
        $schoolgroup = Schoolgroup::find($id);

        $schoolgroup->update($request->request->all());
        return redirect(route('admin-schoolgroup-index'));
    }

    public function delete(Request $request, $id){
        if($request->ajax()) {
            $schoolgroup = Schoolgroup::find($id);
            $schoolgroup->students()->delete();
            $schoolgroup->delete();
        }

        return redirect(route('admin-schoolgroup-index'));

    }
}
