<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class ListUsers extends Command
{
    protected $signature = 'user:list';
    protected $description = 'Tampilkan semua user di aplikasi';

    public function handle()
    {
        $users = User::all(['id', 'name', 'username', 'email', 'role']);

        if ($users->isEmpty()) {
            $this->warn('Tidak ada user di database!');
            return 0;
        }

        $this->info('Daftar User:');
        $this->table(
            ['ID', 'Nama', 'Username', 'Email', 'Role'],
            $users->map(fn($user) => [
                $user->id,
                $user->name,
                $user->username,
                $user->email,
                strtoupper($user->role)
            ])->toArray()
        );

        return 0;
    }
}
