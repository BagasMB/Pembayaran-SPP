<?php

namespace Database\Seeders;

use App\Models\Configuration;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        date_default_timezone_set('Asia/Jakarta');
        $data = [
            'name' => 'SPPKU',
            'email' => 'smkbisa@gmail.com',
            'judul' => 'PEMBAYARAN SPP',
            'alamat' => 'JL. Sriwijaya, Padangan, Jungke, Karanganyar, Jawa Tengah',
            'phone' => '(0271)123456',
            'logo' => 'defaut.png',
        ];

        Configuration::insert([
            'name' => $data['name'],
            'email' => $data['email'],
            'judul' => $data['judul'],
            'alamat' => $data['alamat'],
            'phone' => $data['phone'],
            'logo' => $data['logo'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
