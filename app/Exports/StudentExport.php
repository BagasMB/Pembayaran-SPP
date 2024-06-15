<?php

namespace App\Exports;

use App\Models\ClassRoom;
use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentExport implements FromQuery, WithMapping, WithHeadings
{
    use Exportable;

    private $iteration = 1;

    /**
     * @return \Illuminate\Support\Collection
     */
    public function query()
    {
        return Student::query();
    }

    public function map($student): array
    {
        $kelas = ClassRoom::now_class($student->tahun_masuk, $student->class['name_class']);
        return [
            $this->iteration++,
            $student->nis,
            $student->name,
            $kelas,
            $student->gender,
            $student->tahun_masuk,
            $student->tanggal_lahir,
            $student->alamat,
        ];
    }

    public function headings(): array
    {
        return [
            'No',
            'Nis',
            'Nama',
            'Kelas',
            'Jenis Kelamin',
            'Tahun Masuk',
            'Tanggal Lahir',
            'Alamat',
        ];
    }
}
