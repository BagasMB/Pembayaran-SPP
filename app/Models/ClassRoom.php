<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClassRoom extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    // public function students(): HasMany
    // {
    //     return $this->hasMany(Student::class, 'class_id', 'id');
    // }

    public function students()
    {
        return $this->hasMany(User::class, 'class_id'); // atau sesuaikan nama kolom foreign key-nya
    }

    public function majors(): BelongsTo
    {
        return $this->belongsTo(Major::class, 'major_id', 'id');
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

    public static function class_number($tahun_masuk)
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
        if ($kelas == 0) {
            $kelas = 1;
        } elseif ($kelas == 1) {
            $kelas = 2;
        } elseif ($kelas == 2) {
            $kelas = 3;
        } else {
            $kelas = 4;
        }
        return $kelas;
    }
}
