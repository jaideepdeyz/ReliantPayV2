<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BaseUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //create an admin user
        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@g.com',
            'mobile' => '1234567890',
            'role' => 'Admin',
            'password' => Hash::make('Password123#'),
            'is_active' => 'Yes',
            'is_approved' => 'Yes',
        ]);

        \App\Models\User::create([
            'name' => 'ORGANIC',
            'email' => 'organic@g.com',
            'mobile' => '1234567891',
            'role' => 'Affilate',
            'password' => Hash::make('Password123#'),
            'is_active' => 'Yes',
            'is_approved' => 'Yes',
        ]);
    }
}
