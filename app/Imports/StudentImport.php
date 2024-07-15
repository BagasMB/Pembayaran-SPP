<?php

namespace App\Imports;

use App\Models\ClassRoom;
use DateTime;
use App\Models\Student;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class StudentImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use Importable, SkipsFailures;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    private function excelDateToDate($excelDate)
    {
        if (is_numeric($excelDate)) {
            // Excel date starts from 1 January 1900
            $start_date = '1900-01-01';
            $date = new DateTime($start_date);
            $date->modify("+" . ((int)$excelDate - 2) . " days");
            return $date->format('Y-m-d');
        }

        // If it's already in a valid date format, just return it
        return $excelDate;
    }

    public function model(array $row)
    {
        $class = ClassRoom::where('name_class', $row['kelas'])->first();
        $tanggal_lahir = $this->excelDateToDate($row['tanggal_lahir']);
        if ($class != null) {
            return new Student([
                'nis' => $row['nis'],
                'name' => $row['nama'],
                'class_id' => $class['id'],
                'jenis_kelamin' => $row['jenis_kelamin'],
                'tahun_masuk' => $row['tahun_masuk'],
                'tanggal_lahir' => $tanggal_lahir,
                'alamat' => $row['alamat'],
                'telp' => $row['telp'],
            ]);
        }
    }

    public function rules(): array
    {
        return [
            'nis' => 'required|unique:students|max:4|min:4',
        ];
    }
    // public function customValidationMessages()
    // {
    //     return [
    //         'nis.required' => 'Nis wajib Diisi',
    //         'nis.max' => 'Nis Harus :max Karakter',
    //         'nis.min' => 'Nis Harus :min Karakter',
    //         'nis.unique' => 'Nis Tidak Boleh Sama',
    //         // 'nis.unique' => 'Custom message for :attribute.',
    //     ];
    // }
}
