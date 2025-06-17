<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Daftar role
        $roles = [
            'Super Admin',
            'Guru',
            'Siswa'
        ];

        // Daftar permission
        $permissions = [
            'user',
            'class',
            'guru',
            'siswa',
            'masterdata',
            'pembayaran',
            'transaksi',
            'configuration'
        ];

        // Tambahkan permission ke database
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Aturan permission berdasarkan role
        $rolePermissions = [
            'Super Admin' => Permission::all(),
            'Guru' => Permission::whereNotIn('name', [
                'user',
                'configuration'
            ])->get(),
            'Siswa' => Permission::whereNotIn('name', [
                'user',
                'class',
                'masterdata',
                'pembayaran',
                'configuration'
            ])->get(),
        ];

        // Tambahkan role ke database dan atur permission
        foreach ($roles as $role) {
            $roleModel = Role::firstOrCreate(['name' => $role]);


            // Beri permission jika ada dalam daftar rolePermissions
            if (isset($rolePermissions[$role])) {
                $roleModel->givePermissionTo($rolePermissions[$role]);
            }
        }
    }
}
