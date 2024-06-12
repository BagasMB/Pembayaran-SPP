<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

    public function run(): void
    {
        // User::factory()->create();

        // User::factory()->create([
        //     'Username' => 'Admin',
        //     'name' => 'Bagas',
        //     'email' => 'test@example.com',
        //     'password' => Hash::make('ya'),
        //     'email_verified_at' => now(),
        // ]);

        $this->call([
            ClassRoomSeeder::class,
            UserSeeder::class,
            StudentSeeder::class,
            SppSeeder::class,
            ConfigurationSeeder::class,
        ]);
    }
}
