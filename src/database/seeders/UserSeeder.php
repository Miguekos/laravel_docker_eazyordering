<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'role_id'           => 1,
            'name'              => 'Admin',
            'email'             => 'admin@gmail.com',
            'password'          => Hash::make(123456),  
            'email_verified_at' => now(),
            'remember_token'    => Str::random(60),
        ]);

        $user = User::create([
            'role_id'           => 2,
            'name'              => 'Warehouse',
            'email'             => 'warehouse@gmail.com',
            'password'          => Hash::make(123456),  
            'email_verified_at' => now(),
            'remember_token'    => Str::random(60),
        ]);

        $user = User::create([
            'role_id'           => 3,
            'name'              => 'Manager',
            'email'             => 'manager@gmail.com',
            'password'          => Hash::make(123456),
            'email_verified_at' => now(),
            'remember_token'    => Str::random(60),
        ]);

    }
}
