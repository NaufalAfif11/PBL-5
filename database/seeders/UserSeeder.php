<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Dokter 1',
            'email' => 'dokter@example.com',
            'password' => Hash::make('password'),
            'role' => 'dokter',
        ]);

        User::create([
            'name' => 'Pasien 1',
            'email' => 'pasien@example.com',
            'password' => Hash::make('password'),
            'role' => 'pasien',
        ]);
    }
}
