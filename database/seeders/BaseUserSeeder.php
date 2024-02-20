<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
            'phone_number' => '1234567890',
            'role' => 'Admin',
            'password' => Hash::make('Password123#'),
            'is_active' => 'Yes',
            'is_approved' => 'Yes',
        ]);

        \App\Models\User::create([
            'name' => 'ORGANIC',
            'email' => 'organic@g.com',
            'phone_number' => '1234567891',
            'role' => 'Affilate',
            'password' => Hash::make('Affilate@123#'),
            'is_active' => 'Yes',
            'is_approved' => 'Yes',
        ]);

        \App\Models\User::create([
            'name' => 'TICKETER',
            'email' => 'ticketer@g.com',
            'phone_number' => '1234500000',
            'role' => 'Ticketer',
            'password' => Hash::make('Ticketer@123#'),
            'is_active' => 'Yes',
            'is_approved' => 'Yes',
        ]);
    }
}
