<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Major;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Teknik Mesin'],
            ['name' => 'Teknik Otomotif'],
            ['name' => 'Rekayasa Perangkat Lunak'],
            ['name' => 'Teknik Pembuatan Kain'],
        ];

        foreach ($data as $value) {
            Major::insert([
                'name' => $value['name'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
