<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\ClassRoom;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\Configuration;
use App\Exports\StudentExport;
use App\Imports\StudentImport;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    protected $Transaction;

    public function __construct(Transaction $transaction)
    {
        date_default_timezone_set("Asia/Jakarta");
        $this->Transaction = $transaction;
    }

    public function index()
    {
        return view('pages.student', ['title' => 'Page | Student']);
    }

    public function create()
    {
        return view('pages.form-student', ['title' => 'Form Create Student', 'studentID' => null]);
    }

    public function edit($studentID)
    {
        return view('pages.form-student', ['title' => 'Form Edit Student', 'studentID' => $studentID]);
    }

    public function studentClass($tahun_masuk, $class_id)
    {
        return view('pages.students.student-class', ['title' => 'Page | Student Class', 'tahun_masuk' => $tahun_masuk, 'class_id' => $class_id]);
    }

    public function pembayaran($student_id, $class, $thn1, $thn2)
    {
        $tahun_ajaran = $thn1 . '/' . $thn2;
        return view('pages.students.student-pembayaran', ['title' => 'Page | Student Payments For ' . $tahun_ajaran, 'student_id' => $student_id, 'class' => $class, 'thn1' => $thn1, 'thn2' => $thn2]);
    }

    public function transaksi($id)
    {
        return view('pages.students.student-transaksi', ['title' => 'Page | Student Transaction Data', 'student_id' => $id]);
    }

    public function cetakNota($student_id, $id)
    {
        $data = [
            'title' => 'Nota Pembayaran ',
            'config' => Configuration::find(1),
            'transaksi' => Transaction::with('student', 'spp')->find($id),
            'student' => User::with('class')->find($student_id),
        ];

        $pdf = Pdf::loadView('student-cetak-nota', $data);
        return $pdf->stream();
    }

    public function cetakLaporan($tahun_masuk, $class_id)
    {
        $class = ClassRoom::findOrFail($class_id);
        $tahunSekarang = date('Y');
        $bulanSekarang = date('m');

        // Tentukan bulan awal tahun ajaran baru
        $bulanMulaiTahunAjaran = 7; // Misalnya bulan Juli

        // Hitung selisih tahun
        $selisihTahun = $tahunSekarang - $tahun_masuk;

        // Sesuaikan perhitungan jika bulan sekarang kurang dari bulan awal tahun ajaran
        if ($bulanSekarang < $bulanMulaiTahunAjaran) {
            $selisihTahun--;
        }

        // Tambahkan 1 untuk menghitung kelas, karena siswa baru dimulai dari kelas 1
        $namekelas = $selisihTahun + 1;
        $kelas = $selisihTahun + 1;
        if ($kelas == 0) {
            $kelas = 1;
        } elseif ($kelas == 1) {
            $kelas = 2;
        } elseif ($kelas == 2) {
            $kelas = 3;
        } else {
            $kelas = 4;
        }
        if ($namekelas == 1) {
            $namekelas = 'X ' . $class->name_class;
        } elseif ($namekelas == 2) {
            $namekelas = 'XI ' . $class->name_class;
        } elseif ($namekelas == 3) {
            $namekelas = 'XII ' . $class->name_class;
        } else {
            $namekelas = 'Alumni ' . $tahun_masuk;
        }

        $data = [
            'title' => 'Laporan Kelas ' . $namekelas,
            'config' => Configuration::find(1),
            'student' => User::with('class')->where('tahun_masuk', $tahun_masuk)->where('class_id', $class_id)->orderBy('nis', 'ASC')->get(),
            'namekelas' => $namekelas,
            'kelas' => $kelas,
            'tahun_masuk' => $tahun_masuk,
            'class_id' => $class_id,
        ];
        $pdf = Pdf::loadView('student-cetak-laporan', $data);
        return $pdf->stream();
    }

    public function eksport_excel(Request $request)
    {
        // dd($request->all());
        date_default_timezone_set('Asia/Jakarta');
        return (new StudentExport)->download('student-' . date('ymdHis') . '.xlsx');
        // return Excel::download(new StudentExport, 'student-' . date('ymdHis') . '.xlsx');
    }

    public function import_excel(Request $request)
    {
        Excel::import(new StudentImport, $request->file('excel'));
        flash()->success('Data Berhasil Di Simpan 🎉');
        return back();
    }

    public function transaksiSiswa($id)
    {
        $data = [
            'title' => 'Data Transaksi Siswa',
            'student' => Student::with('class')->find($id),
            'transaksi' => Transaction::with('student')->orderBy('nota', 'desc')->where('student_id', $id)->get(),
        ];
        return view('students.siswa', $data);
    }
}
