<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        if (User::withTrashed()->where('username', 'edu')->exists()) {
            return;
        }
        $user = new User;
        $user->forceFill(['name' => 'edu', 'username' => 'edu', 'email' => 'edu@edufit.local', 'is_admin' => true,
            'email_verified_at' => now(), 'password' => Hash::make('edu12345')])->save();
    }
}
