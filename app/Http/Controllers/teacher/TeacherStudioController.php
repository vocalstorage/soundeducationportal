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
            'description' => 'required|min:20',
            'place' => 'required|string',
            'street' => 'required|string',
            'number' => 'required|int',
            'postal_code' => 'required',
        ]);

        $request['name'] = $request->request->get('studio-name');

        $studio = Auth::user()->studio;

        $studio->update($request->request->all());

        return redirect(route('teacher-edit'));
    }
}
