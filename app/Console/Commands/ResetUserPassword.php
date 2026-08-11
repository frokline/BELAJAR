<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class ResetUserPassword extends Command
{
    protected $signature = 'user:reset-password {username} {password}';
    protected $description = 'Reset password user berdasarkan username';

    public function handle()
    {
        $username = $this->argument('username');
        $password = $this->argument('password');

        $user = User::where('username', $username)->first();

        if (!$user) {
            $this->error("User '{$username}' tidak ditemukan!");
            return 1;
        }

        $user->update(['password' => Hash::make($password)]);

        $this->info("Password user '{$username}' berhasil direset menjadi '{$password}'");
        return 0;
    }
}
