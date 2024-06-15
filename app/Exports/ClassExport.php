<?php

namespace App\Exports;

use App\Models\ClassRoom;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ClassExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    private  $iteration = 1;
    public function collection()
    {
        return ClassRoom::orderBy('name_class', 'ASC')->get();
    }

    public function map($class): array
    {
        return [
            $this->iteration++,
            $class->name_class,
            $class->jurusan,
        ];
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Kelas',
            'Jurusan',
        ];
    }
}
