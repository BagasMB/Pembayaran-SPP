<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Transaction extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function spp()
    {
        return $this->belongsTo(Spp::class, 'tahun_ajaran', 'tahun_ajaran');
    }

    public static function getNota()
    {
        date_default_timezone_set('Asia/Jakarta');

        // Ambil tanggal sekarang dalam format yymm
        $prefix = Carbon::now()->format('ymd'); // contoh: 2505
        // Hitung transaksi bulan ini (gunakan prefix sebagai identifikasi bulan)
        $tanggal = Carbon::now()->format('Y-m');
        $jumlah = DB::table('transactions')->whereRaw("strftime('%Y-%m', tanggal_bayar) = ?", [$tanggal])->count();
        // +1 agar jadi urutan berikutnya
        $urutan =  $jumlah + 1;
        // Gabungkan prefix dan urutan jadi nota unik
        $nota = $prefix . $urutan;
        return $nota; // contoh hasil: 2505002
    }

    public static function nominalTransaksi($id)
    {
        return Transaction::where('id', $id)->selectRaw('SUM( spp1 + spp2 + spp3 ) as nominal')->value('nominal');
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
        $nominal = Transaction::selectRaw('SUM(spp1 + spp2 + spp3) as nominal')->whereRaw("strftime('%Y-%m', tanggal_bayar) = ?", [$month])->first(); //sqlite
        // return DB::table('transactions')->select(DB::raw('SUM(spp1 + spp2 + spp3) as nominal'))->whereRaw("DATE_FORMAT(tanggal_bayar, '%Y-%m') = ?", [$month])->value('nominal'); //mysql
        return $nominal->nominal ?? 0;
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
