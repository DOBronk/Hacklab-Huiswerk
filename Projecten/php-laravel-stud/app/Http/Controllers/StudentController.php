<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\View\View;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    //
    public function index(): View
    {
        $students = Student::all();

        return view("student.list", ['students' => $students]);
    }

    public function create()
    {
        return view('student.create');
    }
    public function show()
    {
        //
    }



}
