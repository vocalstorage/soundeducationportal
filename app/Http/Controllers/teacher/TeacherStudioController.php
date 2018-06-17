<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class TeacherStudioController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'studio-name' => 'required',
            'description' => 'required',
            'place' => 'required',
            'street' => 'required',
            'number' => 'required',
            'postal_code' => 'required',
        ]);

        $request['name'] = $request->request->get('studio-name');

        $studio = Auth::user()->studio;

        $studio->update($request->request->all()->except('studio-name'));

        return redirect(route('teacher-edit'));
    }
}
