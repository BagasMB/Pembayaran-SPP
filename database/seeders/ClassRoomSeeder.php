<?php

namespace Database\Seeders;

use App\Models\ClassRoom;
use Carbon\Carbon;
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
            ['name_class' => 'Mesin A', 'major_id' => 1],
            ['name_class' => 'Mesin B', 'major_id' => 1],
            ['name_class' => 'Mesin C', 'major_id' => 1],
            ['name_class' => 'OTO A', 'major_id' => 2],
            ['name_class' => 'OTO B', 'major_id' => 2],
            ['name_class' => 'OTO C', 'major_id' => 2],
            ['name_class' => 'RPL A', 'major_id' => 3],
            ['name_class' => 'RPL B', 'major_id' => 3],
            ['name_class' => 'RPL C', 'major_id' => 3],
            ['name_class' => 'TPK A', 'major_id' => 4],
            ['name_class' => 'TPK B', 'major_id' => 4],
            ['name_class' => 'TPK C', 'major_id' => 4],
        ];

        foreach ($data as $value) {
            ClassRoom::insert([
                'name_class' => $value['name_class'],
                'major_id' => $value['major_id'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
