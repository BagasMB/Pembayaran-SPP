<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    private function emailFormat($nameUser)
    {
        $emailUsername = strtolower(str_replace([' ', ',', '.', '/', '\'', '-'], '.', $nameUser));

        // Hapus titik ganda yang berulang menggunakan regex
        $emailUsername = preg_replace('/\.+/', '.', $emailUsername);

        // Hapus titik di awal dan akhir agar tidak invalid
        $emailUsername = trim($emailUsername, '.');

        return $emailUsername . '@gmail.com';
    }

    private function usernameFormat($name)
    {
        // Hanya biarkan huruf dan spasi
        $name = strtolower(preg_replace('/[^a-zA-Z ]/', '', $name));

        // Ubah ke lowercase dan hapus spasi
        return strtolower(str_replace(' ', '', $name));
    }

    public function run(): void
    {
        date_default_timezone_set('Asia/Jakarta');
        // Admin
        $superadmin = User::create([
            'name' => 'Super Admin',
            'username' => 'superadmin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('123'),
        ]);
        $superadmin->assignRole('Super Admin');
        $this->command->info('Seeder user SUPER ADMIN berhasil dijalankan.');

        // Guru
        $guru = [
            ['name' => 'Musti', 'nip' => '0000000', 'gender' => 'Perempuan', 'telp' => 81235343, 'tanggal_lahir' => '1999-08-10', 'alamat' => 'sas', 'tahun_masuk' => 2021, 'major_id' => 3],
            ['name' => 'Agung Wiratmo', 'nip' => '0000001', 'gender' => 'Laki-Laki', 'telp' => 81235343, 'tanggal_lahir' => '1995-08-10', 'alamat' => 'sas', 'tahun_masuk' => 2021, 'major_id' => 3],
        ];

        foreach ($guru as $value) {
            $user = User::firstOrCreate(
                ['email' => $this->emailFormat($value['name'])],
                [
                    'username' => $this->usernameFormat($value['name']),
                    'password' => Hash::make('123'),
                    'name' => $value['name'],
                    'nip' => $value['nip'],
                    'gender' => $value['gender'],
                    'major_id' => $value['major_id'],
                    'telp' => $value['telp'],
                    'tahun_masuk' => $value['tahun_masuk'],
                    'tanggal_lahir' => $value['tanggal_lahir'],
                    'alamat' => $value['alamat'],
                ]
            );

            $user->assignRole('Guru');
        }
        $this->command->info('Seeder user Guru berhasil dijalankan.');

        // Siswa
        $siswa = [
            ['name' => 'Bagas Dwi Prasetyo', 'nis' => '8178', 'gender' => 'Laki-Laki', 'telp' => 81235343, 'tanggal_lahir' => '2004-08-10', 'alamat' => 'sas', 'class_id' => 11, 'tahun_masuk' => 2021],
            ['name' => 'Ardy Nur Saputra', 'nis' => '8603', 'gender' => 'Laki-Laki', 'telp' => 81235343, 'tanggal_lahir' => '2007-01-5', 'alamat' => 'kelaa', 'class_id' => 8, 'tahun_masuk' => 2022],
            ['name' => 'Bagas Mahardika Budiharto', 'nis' => '8604', 'gender' => 'Laki-Laki', 'telp' => 81235343, 'tanggal_lahir' => '2007-08-10', 'alamat' => 'Jungke', 'class_id' => 8, 'tahun_masuk' => 2022],
            ['name' => 'Deco Saputro', 'nis' => '8606', 'gender' => 'Laki-Laki', 'telp' => 81235343, 'tanggal_lahir' => '2006-09-22', 'alamat' => 'tegal', 'class_id' => 8, 'tahun_masuk' => 2022],
            ['name' => 'Filip Dwi Utomo', 'nis' => '8614', 'gender' => 'Laki-Laki', 'telp' => 81235343, 'tanggal_lahir' => '2007-05-20', 'alamat' => 'ploso', 'class_id' => 8, 'tahun_masuk' => 2022],
            ['name' => 'Muh Agung Permadi', 'nis' => '9088', 'gender' => 'Laki-Laki', 'telp' => 81235343, 'tanggal_lahir' => '2007-07-22', 'alamat' => 'jungke', 'class_id' => 9, 'tahun_masuk' => 2023],
        ];

        foreach ($siswa as $value) {
            $user = User::firstOrCreate(
                ['email' => $this->emailFormat($value['name'])],
                [
                    'username' => $this->usernameFormat($value['name']),
                    'password' => Hash::make('123'),
                    'nis' => $value['nis'],
                    'name' => $value['name'],
                    'gender' => $value['gender'],
                    'class_id' => $value['class_id'],
                    'telp' => $value['telp'],
                    'tahun_masuk' => $value['tahun_masuk'],
                    'tanggal_lahir' => $value['tanggal_lahir'],
                    'alamat' => $value['alamat'],
                ]
            );

            $user->assignRole('Siswa');
        }
        $this->command->info('Seeder user Siswa berhasil dijalankan.');
    }
}
