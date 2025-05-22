<?php

namespace Database\Seeders;

use App\Models\Spp;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        date_default_timezone_set('Asia/Jakarta');
        $data = [
            ['spp1' => 1200000, 'spp2' => 1300000, 'spp3' => 1800000, 'tahun_ajaran1' => '2024', 'tahun_ajaran2' => '2025'],
            ['spp1' => 1000000, 'spp2' => 1200000, 'spp3' => 1500000, 'tahun_ajaran1' => '2023', 'tahun_ajaran2' => '2024'],
            ['spp1' => 100000, 'spp2' => 200000, 'spp3' => 500000, 'tahun_ajaran1' => '2022', 'tahun_ajaran2' => '2023'],
            ['spp1' => 110000, 'spp2' => 120000, 'spp3' => 150000, 'tahun_ajaran1' => '2021', 'tahun_ajaran2' => '2022'],
        ];

        foreach ($data as $value) {
            Spp::insert([
                'spp1' => $value['spp1'],
                'spp2' => $value['spp2'],
                'spp3' => $value['spp3'],
                'tahun_ajaran' => $value['tahun_ajaran1'] . '/' . $value['tahun_ajaran2'],
                'tahun_ajaran1' => $value['tahun_ajaran1'],
                'tahun_ajaran2' => $value['tahun_ajaran2'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
