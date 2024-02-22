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
        //create a Super Admin user
        \App\Models\User::create([
            'name' => 'Jaideep Dey',
            'email' => 'jaideep.deyz@gmail.com',
            'phone_number' => '9591989321',
            'role' => 'Super Admin',
            'password' => Hash::make('RoPH6Cr8bRow&S6!H3SW'),
            'is_active' => 'Yes',
            'is_approved' => 'Yes',
            'organization_id' => 1,
        ]);

        

        //create an admin user
        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@g.com',
            'phone_number' => '1234567890',
            'role' => 'Admin',
            'password' => Hash::make('Password123#'),
            'is_active' => 'Yes',
            'is_approved' => 'Yes',
            'organization_id' => 1,
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
            'organization_id' => 1,
        ]);
        \App\Models\User::create([
            'name' => 'FINANCE',
            'email' => 'finance@g.com',
            'phone_number' => '1234500222',
            'role' => 'Ticketer',
            'password' => Hash::make('Finace@123#'),
            'is_active' => 'Yes',
            'is_approved' => 'Yes',
            'organization_id' => 1,
        ]);
    }
}
