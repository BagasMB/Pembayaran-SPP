<?php

namespace Database\Seeders;

use App\Models\ClassRoom;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        date_default_timezone_set('Asia/Jakarta');
        $data = [
            ['name_class' => 'Mesin A', 'jurusan' => 'Teknik Mesin'],
            ['name_class' => 'Mesin B', 'jurusan' => 'Teknik Mesin'],
            ['name_class' => 'Mesin C', 'jurusan' => 'Teknik Mesin'],
            ['name_class' => 'OTO A', 'jurusan' => 'Teknik Otomotif'],
            ['name_class' => 'OTO B', 'jurusan' => 'Teknik Otomotif'],
            ['name_class' => 'OTO C', 'jurusan' => 'Teknik Otomotif'],
            ['name_class' => 'RPL A', 'jurusan' => 'Rekayasa Perangkat Lunak'],
            ['name_class' => 'RPL B', 'jurusan' => 'Rekayasa Perangkat Lunak'],
            ['name_class' => 'RPL C', 'jurusan' => 'Rekayasa Perangkat Lunak'],
            ['name_class' => 'TPK A', 'jurusan' => 'Teknik Pembuatan Kain'],
            ['name_class' => 'TPK B', 'jurusan' => 'Teknik Pembuatan Kain'],
            ['name_class' => 'TPK C', 'jurusan' => 'Teknik Pembuatan Kain'],
        ];

        foreach ($data as $value) {
            ClassRoom::insert([
                'name_class' => $value['name_class'],
                'jurusan' => $value['jurusan'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
