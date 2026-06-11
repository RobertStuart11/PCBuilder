<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name'     => 'Admin PCBuilder',
            'email'    => 'admin@pcbuilder.com',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);

        // Seller
        User::create([
            'name'    => 'Toko TechMart',
            'email'   => 'seller@pcbuilder.com',
            'password'=> Hash::make('password'),
            'role'    => 'seller',
            'phone'   => '081234567890',
            'address' => 'Jl. Raya Darmo No. 10, Surabaya',
        ]);

        // Buyer
        User::create([
            'name'    => 'Budi Santoso',
            'email'   => 'buyer@pcbuilder.com',
            'password'=> Hash::make('password'),
            'role'    => 'buyer',
            'phone'   => '089876543210',
            'address' => 'Jl. Pemuda No. 5, Surabaya',
        ]);
    }
}