<?php

namespace Database\Seeders;

use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Bagas Dwi Prasetyo', 'nis' => '8178', 'gender' => 'Laki-Laki', 'tanggal_lahir' => '2004-08-10', 'alamat' => 'sas', 'class_id' => 11, 'tahun_masuk' => 2021],
            ['name' => 'Ardy Nur Saputra', 'nis' => '8603', 'gender' => 'Laki-Laki', 'tanggal_lahir' => '2007-01-5', 'alamat' => 'kelaa', 'class_id' => 8, 'tahun_masuk' => 2022],
            ['name' => 'Bagas Mahardika Budiharto', 'nis' => '8604', 'gender' => 'Laki-Laki', 'tanggal_lahir' => '2007-08-10', 'alamat' => 'Jungke', 'class_id' => 8, 'tahun_masuk' => 2022],
            ['name' => 'Deco Saputro', 'nis' => '8606', 'gender' => 'Laki-Laki', 'tanggal_lahir' => '2006-09-22', 'alamat' => 'tegal', 'class_id' => 8, 'tahun_masuk' => 2022],
            ['name' => 'Filip Dwi Utomo', 'nis' => '8614', 'gender' => 'Laki-Laki', 'tanggal_lahir' => '2007-05-20', 'alamat' => 'ploso', 'class_id' => 8, 'tahun_masuk' => 2022],
            ['name' => 'Muh Agung Permadi', 'nis' => '9088', 'gender' => 'Laki-Laki', 'tanggal_lahir' => '2007-07-22', 'alamat' => 'jungke', 'class_id' => 9, 'tahun_masuk' => 2023],
        ];

        foreach ($data as $value) {
            Student::insert([
                'name' => $value['name'],
                'nis' => $value['nis'],
                'gender' => $value['gender'],
                'tanggal_lahir' => $value['tanggal_lahir'],
                'class_id' => $value['class_id'],
                'tahun_masuk' => $value['tahun_masuk'],
                'alamat' => $value['alamat'],
                'spp1' => 0,
                'spp2' => 0,
                'spp3' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
