<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@magdiwata.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create a regular customer user for testing
        User::create([
            'name' => 'Customer User',
            'email' => 'customer@magdiwata.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);
    }
}
