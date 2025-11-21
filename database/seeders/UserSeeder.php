<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

//Seed user awal (admin) untuk login. contoh data user gampang
class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'username' => 'eric',
            'name'     => 'Administrator',
            'email'    => 'eric@example.com',
            'password' => Hash::make('eric123'), 
        ]);
    }
}
