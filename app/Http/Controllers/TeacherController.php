<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $teachers = Teacher::latest()->get();
    
        return view('admin.teacher.index',compact('teachers'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function create()
    {
    return view('admin.teacher.create');
    }


    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        Teacher::create([
            'name' => $request->name,
        ]);
        return redirect()->route('teachers.index')
        ->with('success','Teacher has been created successfully.');
    }

    public function edit(Teacher $teacher)
    {
    return view('admin.teacher.edit',compact('teacher'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $teacher = Teacher::findOrFail($id);
        $teacher->name = $request->name;
        $teacher->save();
        return redirect()->route('teachers.index')
        ->with('success','Teacher has been updated successfully');
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return redirect()->route('teachers.index')
        ->with('success','Teacher has been deleted successfully');
    }
}
