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
        // $class = DB::table('class_rooms')->join('teachers', 'class_rooms.teacher_id', '=', 'teachers.id')->get(['name_class', 'name_teacher', 'class_rooms.id', 'teacher_id']);
        $class = ClassRoom::orderBy('name_class', 'ASC')->get();
        // dd(ClassRoom::with('walikelas'));
        return view('classroom', ['title' => 'ClassRoom', 'classList' => $class]);
    }

    public function simpan(Request $request)
    {
        $validated = $request->validate(
            [
                'name_class' => 'required',
                'jurusan' => 'required',
            ],
            [
                'name_class.required' => 'Data Nama Kelas wajib Diisi',
                'jurusan.required' => 'Data Jurusan wajib Diisi',
            ]
        );
        ClassRoom::create($request->all());
        flash()->success('Data Berhasil Di Simpan 🎉');
        return redirect('/classroom');
    }

    public function eksport_excel(Request $request)
    {
        // dd($request->all());
        date_default_timezone_set('Asia/Jakarta');
        return Excel::download(new ClassExport, 'class-' . date('ymdHis') . '.xlsx');
    }

    public function import_excel(Request $request)
    {
        // dd($request->all());
        Excel::import(new ClassImport, $request->file('excel'));
        flash()->success('Data Berhasil Di Simpan 🎉');
        return back();
    }

    public function update(Request $request, FlasherInterface $flasher)
    {
        ClassRoom::findorfail($request->id)->update($request->all());
        flash()->success('Data Berhasil Di Ubah 🎉');
        return redirect('/classroom');
    }

    public function hapus($id)
    {
        ClassRoom::findorfail($id)->delete();
        flash()->success('Data Berhasil Di Hapus 🎉');
        return redirect('/classroom');
    }
}
