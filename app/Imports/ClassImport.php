<?php

namespace App\Imports;

use App\Models\ClassRoom;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ClassImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        $index1 = 1;
        foreach ($collection as $value) {
            if ($index1 > 1) {
                $data['name_class'] = !empty($value[0]) ? $value[0] : '';
                $data['jurusan']    = !empty($value[1]) ? $value[1] : '';

                ClassRoom::create($data);
            }

            $index1++;
        }
    }
}
