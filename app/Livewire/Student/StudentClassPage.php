<?php

namespace App\Livewire\Student;

use App\Models\Spp;
use App\Models\User;
use Livewire\Component;
use App\Models\ClassRoom;
use App\Models\Transaction;

class StudentClassPage extends Component
{
    public $tahun_masuk;
    public $class_id;
    public $data = [];
    public $namekelas;
    public $kelas;

    public function mount($tahun_masuk, $class_id)
    {
        $this->tahun_masuk = $tahun_masuk;
        $class = ClassRoom::findOrFail($class_id);
        $this->kelas = ClassRoom::class_number($tahun_masuk);
        $this->namekelas = ClassRoom::now_class($tahun_masuk, $class->name_class);

        $this->data = User::with('class')->siswa()->where('tahun_masuk', $tahun_masuk)->where('class_id', $class_id)->orderBy('nis', 'ASC')->get();
    }

    public function getPaymentButtons($student)
    {
        $buttons = [];
        $tahunMasuk = $student->tahun_masuk;
        $maxYears = min($this->kelas, 3);

        for ($i = 1; $i <= $maxYears; $i++) {
            $tahun1 = $tahunMasuk + ($i - 1);
            $tahun2 = $tahun1 + 1;
            $label = "{$tahun1}/{$tahun2}";
            $spp = Spp::where('tahun_ajaran', $label)->first();
            $sppField = 'spp' . $i;

            // Ambil nilai tagihan dari tabel users
            $sppTagihan = $spp->$sppField ?? 0;

            // Hitung total pembayaran untuk tahun ajaran dan sppX
            $totalBayar = Transaction::where('student_id', $student->id)
                ->where('tahun_ajaran', $label)
                ->sum($sppField);

            // Cek status pembayaran
            if ($totalBayar >= $sppTagihan) {
                $style = 'success';
            } elseif ($totalBayar < $sppTagihan && $totalBayar > 0) {
                $style = 'info';
            } else {
                $style = 'danger';
            }

            $buttons[] = [
                'url' => route('student.pembayaran', [
                    'student_id' => $student->id,
                    'class' => $i,
                    'thn1' => $tahun1,
                    'thn2' => $tahun2
                ]),
                'label' => $label,
                'style' => $style,
            ];
        }

        return $buttons;
    }


    public function render()
    {
        return view('livewire.student.student-class-page');
    }
}
