<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        return view('pages.teacher', ['title' => 'Page | Guru']);
    }

    public function create()
    {
        return view('pages.form-teacher', ['title' => 'Form Create Teacher', 'TeacherID' => null]);
    }

    public function edit($TeacherID)
    {
        return view('pages.form-teacher', ['title' => 'Form Edit Teacher', 'TeacherID' => $TeacherID]);
    }
}
