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
    public function run(): void
    {
        date_default_timezone_set('Asia/Jakarta');
        $data = [
            ['username' => 'admin', 'password' => Hash::make('ya'), 'name' => 'Bagas', 'role' => 'Admin', 'email' => 'bgs@gmail.com', 'email_verified_at' => now(), 'remember_token' => Str::random(10)],
            ['username' => 'user', 'password' => Hash::make('ya'), 'name' => 'Chiss', 'role' => 'Staff', 'email' => 'budi@gmail.com', 'email_verified_at' => now(), 'remember_token' => Str::random(10)],
            ['username' => 'jokowi', 'password' => Hash::make('ya'), 'name' => 'Koko', 'role' => 'Staff', 'email' => 'koko@gmail.com', 'email_verified_at' => now(), 'remember_token' => Str::random(10)],
        ];

        foreach ($data as $value) {
            User::insert([
                'username' => $value['username'],
                'password' => $value['password'],
                'name' => $value['name'],
                'role' => $value['role'],
                'email' => $value['email'],
                'email_verified_at' => $value['email_verified_at'],
                'remember_token' => $value['remember_token'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
