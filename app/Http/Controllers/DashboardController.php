<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\Spp;
use App\Models\Student;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'cont_student' => Student::count(),
            'cont_spp' => Spp::count(),
            'cont_class' => ClassRoom::count(),
            'transbulan' => Transaction::transaksibulanan(),
            'jmltransaksiToday' => Transaction::jmltransaksiHariIni(),
            'transaksi' => Transaction::with('student')->orderBy('tanggal_bayar', 'DESC')->take(5)->get(),
        ];
        return view('dashboard', $data);
    }

    public function audio()
    {
        $data = [
            'title' => 'Audio',
        ];
        return view('audio', $data);
    }
}
