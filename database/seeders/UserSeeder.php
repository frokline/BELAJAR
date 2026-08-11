<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Akun Admin Default (ID: 1)
        User::create([
            'name'     => 'Administrator Toko',
            'username' => 'admin',
            'email'    => 'admin@toko.com',
            'password' => Hash::make('password123'),
            'role'     => 'admin',
        ]);

        // 2. Akun Kasir Default (ID: 2)
        User::create([
            'name'     => 'Kasir Utama',
            'username' => 'kasir',
            'email'    => 'kasir@toko.com',
            'password' => Hash::make('password123'),
            'role'     => 'kasir',
        ]);
    }
}