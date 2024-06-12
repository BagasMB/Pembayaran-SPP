<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\Configuration;
use App\Models\Spp;
use App\Models\Student;
use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $studentList = Student::with('class')->orderBy('nis', 'ASC')->get();
        // $studentList = DB::table('students')->join('class_rooms', 'class_rooms.id', '=', 'students.class_id')->orderBy('nis', 'ASC')->get(['students.id', 'name', 'nis', 'name_class', 'class_id', 'gender', 'tahun_masuk']);
        $class = ClassRoom::select('id', 'name_class')->orderBy('name_class', 'ASC')->get();
        return view('student', ['title' => 'Page | Student', 'studentList' => $studentList, 'class' => $class]);
    }

    public function studentClass($tahun_masuk, $class_id)
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

        $data = Student::with('class')->where('tahun_masuk', $tahun_masuk)->where('class_id', $class_id)->orderBy('nis', 'ASC')->get();
        return view('student-class', ['title' => 'Page | Student Class', 'data' => $data, 'namekelas' => $namekelas, 'kelas' => $kelas, 'tahun_masuk' => $tahun_masuk, 'class_id' => $class_id]);
    }

    public function pembayaran($student_id, $class, $tahun1, $tahun2)
    {
        $tahun_ajaran = $tahun1 . '/' . $tahun2;
        $data = [
            'title' => 'Page | Student Payments For ' . $tahun_ajaran,
            'tahun_ajaran' => $tahun_ajaran,
            'class' => $class,
            'student' => Student::with('class')->find($student_id),
            'spp' => Spp::where('tahun_ajaran', $tahun_ajaran)->first(),
        ];
        return view('student-pembayaran', $data);
    }

    public function bayar(Request $request)
    {
        $nota = Transaction::getNota();
        $kelas = $request->kelas;
        if ($kelas == 1) {
            $data = [
                'nota' => $nota,
                'spp1' => $request->input('spp1'),
                'tahun_ajaran' => $request->input('tahun_ajaran'),
                'student_id' => $request->input('student_id'),
                'tanggal_bayar' => $request->input('tanggal_bayar'),
            ];
            $studentbayar = [
                'spp1' => $request->input('spp1') + $request->input('spp1_lama'),
            ];
        } elseif ($kelas == 2) {
            $data = [
                'nota' => $nota,
                'spp2' => $request->input('spp2'),
                'tahun_ajaran' => $request->input('tahun_ajaran'),
                'student_id' => $request->input('student_id'),
                'tanggal_bayar' => $request->input('tanggal_bayar'),
            ];
            $studentbayar = [
                'spp2' => $request->input('spp2') + $request->input('spp2_lama'),
            ];
        } elseif ($kelas == 3) {
            $data = [
                'nota' => $nota,
                'spp3' => $request->input('spp3'),
                'tahun_ajaran' => $request->input('tahun_ajaran'),
                'student_id' => $request->input('student_id'),
                'tanggal_bayar' => $request->input('tanggal_bayar'),
            ];
            $studentbayar = [
                'spp3' => $request->input('spp3') + $request->input('spp3_lama'),
            ];
        }
        DB::transaction(function () use ($request, $studentbayar, $data) {
            // Update data siswa
            $siswa = Student::findorfail($request->input('student_id'));
            $siswa->update($studentbayar);

            // Insert ke tabel Transaksi
            Transaction::create($data);
        });
        flash()->success('Pembayaran Berhasil 🎉');
        return redirect('/student/transaksi/' . $request->input('student_id'));
    }

    public function transaksi($id)
    {
        $data = [
            'title' => 'Page | Student Transaction Data',
            'student' => Student::with('class')->find($id),
            'transaksi' => Transaction::with('student')->where('student_id', $id)->get(),
        ];
        return view('student-transaksi', $data);
    }

    public function cetakNota(Request $request, $student_id, $id)
    {
        $data = [
            'title' => 'Nota Pembayaran ',
            'config' => Configuration::find(1),
            'transaksi' => Transaction::with('student', 'spp')->find($id),
            'student' => Student::with('class')->find($student_id),
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
            'student' => Student::with('class')->where('tahun_masuk', $tahun_masuk)->where('class_id', $class_id)->orderBy('nis', 'ASC')->get(),
            'namekelas' => $namekelas,
            'kelas' => $kelas,
            'tahun_masuk' => $tahun_masuk,
            'class_id' => $class_id,
        ];
        $pdf = Pdf::loadView('student-cetak-laporan', $data);
        return $pdf->stream();
    }

    public function simpan(Request $request)
    {
        $validated = $request->validate(
            [
                'nis' => 'required|unique:students|max:4|min:4',
                'tahun_masuk' => 'required|integer|min:2019|max:' . Carbon::now()->year,
            ],
            [
                'nis.required' => 'Nis wajib Diisi',
                'name.required' => 'Name wajib Diisi',
                'tahun_masuk.required' => 'Tahun Masuk Wajib DIisi',
                'nis.max' => 'Nis Harus :max Karakter',
                'nis.min' => 'Nis Harus :min Karakter',
                'tahun_masuk.min' => 'Tahun Masuk Minimal Tahun :min',
                'tahun_masuk.max' => 'Tahun Masuk Maksimal Tahun :max',
                'nis.unique' => 'Nis Tidak Boleh Sama',
            ]
        );

        Student::create($request->all());
        flash()->success('Data Berhasil Di Simpan 🎉');
        return redirect('/student');
    }

    public function update(Request $request)
    {
        $validated = $request->validate(
            [
                'nis' => 'required|max:4|min:4',
                'tahun_masuk' => 'required|integer|min:2019|max:' . Carbon::now()->year,
            ],
            [
                'nis.required' => 'Nis wajib Diisi',
                'name.required' => 'Name wajib Diisi',
                'tahun_masuk.required' => 'Tahun Masuk Wajib DIisi',
                'nis.max' => 'Nis Harus :max Karakter',
                'nis.min' => 'Nis Harus :min Karakter',
                'tahun_masuk.min' => 'Tahun Masuk Minimal Tahun :min',
                'tahun_masuk.max' => 'Tahun Masuk Maksimal Tahun :max',
            ]
        );

        Student::findorfail($request->id)->update($request->all());
        flash()->success('Data Berhasil Di Ubah 🎉');
        return redirect('/student');
    }

    public function hapus($id)
    {
        Student::findorfail($id)->delete();
        flash()->success('Data Berhasil Di Hapus 🎉');
        return redirect('/student');
    }
}
