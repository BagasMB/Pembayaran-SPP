<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MajorController extends Controller
{
    public function index()
    {
        return view('pages.major', ['title' => 'Page | Major']);
    }

    public function create()
    {
        return view('pages.form-major', ['title' => 'Form Create Major', 'majorID' => null]);
    }

    public function edit($majorID)
    {
        return view('pages.form-major', ['title' => 'Form Edit Major', 'majorID' => $majorID]);
    }
}
