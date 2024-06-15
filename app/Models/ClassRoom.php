<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClassRoom extends Model
{
    use HasFactory;
    protected $fillable = ['name_class', 'jurusan'];

    public function students(): HasMany
    {
        return $this->hasMany(Student::class, 'class_id', 'id');
    }

    public static function now_class($tahun_masuk, $name_class)
    {
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
        $kelas = $selisihTahun + 1;
        if ($kelas == 1) {
            $kelas = 'X ' . $name_class;
        } elseif ($kelas == 2) {
            $kelas = 'XI ' . $name_class;
        } elseif ($kelas == 3) {
            $kelas = 'XII ' . $name_class;
        } else {
            $kelas = 'Alumni ' . $tahun_masuk;
        }
        return $kelas;
    }
}
