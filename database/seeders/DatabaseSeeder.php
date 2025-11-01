<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            BidangSeeder::class,
        ]);

        // === Buat role default ===
        $roles = ['Admin', 'Tamu'];
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // === Buat user Admin ===
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin Dinas',
                'password' => Hash::make('password'),
            ]
        );
        $admin->assignRole('Admin');

        // === Buat user Tamu (opsional, jika login disediakan untuk tamu) ===
        $tamu = User::firstOrCreate(
            ['email' => 'tamu@example.com'],
            [
                'name' => 'Tamu Umum',
                'password' => Hash::make('password'),
            ]
        );
        $tamu->assignRole('Tamu');
    }
}
