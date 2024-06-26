<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = ['nota', 'tahun_ajaran', 'tanggal_bayar', 'student_id', 'spp1', 'spp2', 'spp3'];


    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function spp()
    {
        return $this->belongsTo(Spp::class, 'tahun_ajaran', 'tahun_ajaran');
    }

    public static function getNota()
    {
        date_default_timezone_set('Asia/Jakarta');

        // Get current year-month
        $tanggal = Carbon::now()->format('Y-m');

        // Get the count of sales for the current month
        $jumlah = DB::table('transactions')
            ->whereRaw("DATE_FORMAT(tanggal_bayar, '%Y-%m') = ?", [$tanggal])
            ->count();

        // Generate nota number
        $nota = Carbon::now()->format('ymd') . ($jumlah + 1);

        return $nota;
    }

    public static function nominalTransaksi($id)
    {
        return DB::table('transactions')->where('id', $id)->selectRaw('SUM( spp1 + spp2 + spp3 ) as nominal')->value('nominal');
    }

    public static function jmltransaksiHariIni()
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = Carbon::today()->toDateString();
        return Transaction::whereDate('tanggal_bayar', $date)->count();
        // $date = date('Y-m-d');
        // return DB::table('transactions')->select(DB::raw('SUM(spp1 + spp2 + spp3) as nominal'))->whereRaw("DATE_FORMAT(tanggal_bayar, '%Y-%m-%d') = ?", [$date])->value('nominal');
    }

    public static function transaksibulanan()
    {
        $month = date('Y-m');
        return DB::table('transactions')->select(DB::raw('SUM(spp1 + spp2 + spp3) as nominal'))->whereRaw("DATE_FORMAT(tanggal_bayar, '%Y-%m') = ?", [$month])->value('nominal');
    }

    public static function total_kelas1($id)
    {
        return Spp::where('tahun_ajaran', $id)->sum('spp1');
    }

    public static function total_kelas2($id)
    {
        return Spp::where('tahun_ajaran', $id)->sum('spp2');
    }

    public static function total_kelas3($id)
    {
        return DB::table('spps')
            ->select(DB::raw('SUM(spp3) as nominal'))
            ->Where('tahun_ajaran', $id)
            ->value('nominal');
    }

    public static function stotalKelas1($id)
    {
        return Student::where('id', $id)->sum('spp1');
    }

    public static function stotalKelas2($id)
    {
        return Student::where('id', $id)->sum('spp2');
    }

    public static function stotalKelas3($id)
    {
        return Student::where('id', $id)->sum('spp3');
    }
}
