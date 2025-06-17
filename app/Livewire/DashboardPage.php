<?php

namespace App\Livewire;

use App\Models\Spp;
use App\Models\Student;
use Livewire\Component;
use App\Models\ClassRoom;
use App\Models\Transaction;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class DashboardPage extends Component
{
    public $title = 'Dashboard';
    public $cont_student, $cont_spp, $cont_class, $transbulan, $jmltransaksiToday, $transaksi;

    public function mount()
    {
        $this->cont_student = Student::count();
        $this->cont_spp = Spp::count();
        $this->cont_class = ClassRoom::count();
        $this->transbulan = Transaction::transaksibulanan();
        $this->jmltransaksiToday = Transaction::jmltransaksiHariIni();
        $this->transaksi = Transaction::with('student')->orderBy('nota', 'DESC')->take(5)->get();
    }

    public function render()
    {
        return view('livewire.dashboard-page');
    }
}
