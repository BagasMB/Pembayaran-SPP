<?php

namespace App\Livewire\Student;

use App\Models\User;
use Livewire\Component;
use App\Models\ClassRoom;
use App\Models\Transaction;

class StudentTransaksiPage extends Component
{
    public $student, $transaksi;
    public $kelas_now;
    public $transactionTotals = [];

    public function mount($student_id)
    {
        $this->student = User::with('class')->find($student_id);
        $this->transaksi = Transaction::with('user')->where('student_id', $student_id)->orderBy('nota', 'DESC')->get();
        $this->kelas_now = ClassRoom::now_class($this->student->tahun_masuk, $this->student->class->name_class);

        // Hitung total nominal tiap transaksi
        foreach ($this->transaksi as $trx) {
            $this->transactionTotals[$trx->id] = $trx->nominalTransaksi($trx->id);
        }
    }
    public function render()
    {
        return view('livewire.student.student-transaksi-page');
    }
}
