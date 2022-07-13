<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $students = Student::latest()->get();
    
        return view('admin.student.index',compact('students'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function create()
    {
        $teachers = Teacher::all();
        return view('admin.student.create',compact('teachers'));
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
            'name' => 'required',
            'age' => 'required|numeric',
            'gender' => 'required',
            'teacher_id' => 'required',
        ]);

        Student::create([
            'name' => $request->name,
            'age' => $request->age,
            'gender' => $request->gender,
            'teacher_id' => $request->teacher_id,
        ]);
        return redirect()->route('students.index')
        ->with('success','Student has been created successfully.');
    }

    public function edit(Student $student)
    {
        
        $teachers = Teacher::all();
        return view('admin.student.edit',compact('teachers','student'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'age' => 'required|numeric',
            'gender' => 'required',
            'teacher_id' => 'required',
        ]);
        $student = Student::findOrFail($id);
        $student->name = $request->name;
        $student->age = $request->age;
        $student->gender = $request->gender;
        $student->teacher_id = $request->teacher_id;
        $student->save();
        return redirect()->route('students.index')
        ->with('success','Student has been updated successfully');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')
        ->with('success','Student has been deleted successfully');
    }
}
