<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'nis', 'gender', 'class_id', 'tahun_masuk', 'tanggal_lahir', 'alamat', 'spp1', 'spp2', 'spp3'];

    public function class(): BelongsTo
    {
        return $this->belongsTo(ClassRoom::class);
    }

    public function payments()
    {
        return $this->hasMany(Transaction::class, 'student_id');
    }

    public function angkatan($angkatan)
    {
        $currentYear = date('Y');
        $kelas1 = $currentYear - $angkatan;
        $kelas2 = $currentYear - $angkatan - 1;
        $bulan = date('m'); //cek bulan ke 7 apa bukan?

        if ($bulan > 6) {
            if ($kelas1 == 0) {
                $kelas = "Kelas X";
            } elseif ($kelas1 == 1) {
                $kelas = "Kelas XI";
            } elseif ($kelas1 == 2) {
                $kelas = "Kelas XII";
            } else {
                $kelas = 'Alumni ' . $angkatan;
            }
        } else {
            if ($kelas2 == 0) {
                $kelas = "Kelas X";
            } elseif ($kelas2 == 1) {
                $kelas = "Kelas XI";
            } elseif ($kelas2 == 2) {
                $kelas = "Kelas XII";
            } else {
                $kelas = 'Alumni ' . $angkatan;
            }
        }

        return $kelas;
    }
}
