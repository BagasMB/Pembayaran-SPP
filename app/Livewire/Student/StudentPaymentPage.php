<?php

namespace App\Livewire\Student;

use App\Models\Spp;
use App\Models\User;
use Livewire\Component;
use App\Models\ClassRoom;
use App\Models\Transaction;

class StudentPaymentPage extends Component
{
    public $student_id, $class, $tahun1, $tahun2;
    public $student, $spp, $tahun_ajaran;
    public $nominal, $tanggal_bayar;
    public $sisa, $kelas_now;
    public $sppsudahdibayar, $spptagihan;

    public function mount($student_id, $class, $thn1, $thn2)
    {
        $this->student_id = $student_id;
        $this->class = $class;
        $this->tahun1 = $thn1;
        $this->tahun2 = $thn2;

        $this->tahun_ajaran = $this->tahun1 . '/' . $this->tahun2;
        $this->student = User::with('class')->findOrFail($this->student_id);
        $this->spp = Spp::where('tahun_ajaran', $this->tahun_ajaran)->firstOrFail();

        $this->sppsudahdibayar = $class == 1 ? $this->student->spp1 : ($class == 2 ? $this->student->spp2 : $this->student->spp3);
        $this->spptagihan = $class == 1 ? $this->spp->spp1 : ($class == 2 ? $this->spp->spp2 : $this->spp->spp3);
        $this->sisa = $this->spptagihan - $this->sppsudahdibayar;

        // $this->updateSisa();
        $this->kelas_now = ClassRoom::now_class($this->student->tahun_masuk, $this->student->class->name_class);
    }

    // private function updateSisa()
    // {
    //     if ($this->sisa <= 0) {
    //     } else {
    //         $this->sisa = $this->spptagihan - ($this->sppsudahdibayar + $this->nominal);
    //     }
    // }

    public function bayar()
    {
        $this->validate([
            'nominal' => 'required|numeric|min:1',
            'tanggal_bayar' => 'required|date',
        ]);

        $nota = Transaction::getNota();
        // dd($nota);
        if ($this->class == 1) {
            $sisa_spp = $this->spp->spp1 - $this->student->spp1;
            if ($this->nominal > $sisa_spp) {
                flash()->warning('Nominal terlalu banyak 🎉');
                return;
            }
            $data = [
                'nota' => $nota,
                'spp1' => $this->nominal,
                'tahun_ajaran' => $this->tahun_ajaran,
                'student_id' => $this->student->id,
                'tanggal_bayar' => $this->tanggal_bayar,
            ];

            $studentbayar = [
                'spp1' => $this->student->spp1 + $this->nominal,
            ];
        } elseif ($this->class == 2) {
            $sisa_spp = $this->spp->spp2 - $this->student->spp2;
            if ($this->nominal > $sisa_spp) {
                flash()->warning('Nominal terlalu banyak 🎉');
                return;
            }
            $data = [
                'nota' => $nota,
                'spp2' => $this->nominal,
                'tahun_ajaran' => $this->tahun_ajaran,
                'student_id' => $this->student->id,
                'tanggal_bayar' => $this->tanggal_bayar,
            ];

            $studentbayar = [
                'spp2' => $this->student->spp2 + $this->nominal,
            ];
        } elseif ($this->class == 3) {
            $sisa_spp = $this->spp->spp3 - $this->student->spp3;
            if ($this->nominal > $sisa_spp) {
                flash()->warning('Nominal terlalu banyak 🎉');
                return;
            }
            $data = [
                'nota' => $nota,
                'spp3' => $this->nominal,
                'tahun_ajaran' => $this->tahun_ajaran,
                'student_id' => $this->student->id,
                'tanggal_bayar' => $this->tanggal_bayar,
            ];

            $studentbayar = [
                'spp3' => $this->student->spp3 + $this->nominal,
            ];
        }
        Transaction::create($data);
        User::findOrFail($this->student_id)->update($studentbayar);
        $this->student = User::with('class')->findOrFail($this->student_id);
        // Perbarui data pembayaran dan tagihan
        $this->sppsudahdibayar = $this->class == 1 ? $this->student->spp1 : ($this->class == 2 ? $this->student->spp2 : $this->student->spp3);
        $this->spptagihan = $this->class == 1 ? $this->spp->spp1 : ($this->class == 2 ? $this->spp->spp2 : $this->spp->spp3);

        // Update sisa berdasarkan data terbaru
        $this->sisa = $this->spptagihan - $this->sppsudahdibayar;
        // $this->updateSisa();
        $this->nominal = 0;
        $this->tanggal_bayar = null;
        flash()->success('Pembayaran berhasil diproses 🎉');
        return redirect('/student/transaksi/' . $this->student_id);
    }

    public function render()
    {
        return view('livewire.student.student-payment-page', [
            'title' => 'Page | Student Payments For ' . $this->tahun_ajaran,
        ]);
    }
}
