<?php

namespace App\Http\Controllers;

use App\Exports\ClassExport;
use App\Imports\ClassImport;
use App\Models\ClassRoom;
use Flasher\Prime\FlasherInterface;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ClassController extends Controller
{
    public function index()
    {
        return view('pages.classroom', ['title' => 'ClassRoom']);
    }

    public function create()
    {
        return view('pages.form-class', ['title' => 'Form Tambah Class', 'classID' => null]);
    }

    public function edit($classID)
    {
        return view('pages.form-class', ['title' => 'Form Edit Class', 'classID' => $classID]);
    }

    // public function eksport_excel(Request $request)
    // {
    //     // dd($request->all());
    //     date_default_timezone_set('Asia/Jakarta');
    //     return Excel::download(new ClassExport, 'class-' . date('ymdHis') . '.xlsx');
    // }

    // public function import_excel(Request $request)
    // {
    //     // dd($request->all());
    //     Excel::import(new ClassImport, $request->file('excel'));
    //     flash()->success('Data Berhasil Di Simpan 🎉');
    //     return back();
    // }

    public function destroy($id)
    {
        ClassRoom::findorfail($id)->delete();
        flash()->success('Data Berhasil Di Hapus 🎉');
        return redirect('/classroom');
    }
}
