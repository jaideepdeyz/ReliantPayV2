<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BaseOrgSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Organization::create([
            'user_id' => 1,
            'business_name' => 'Reliant Payment Systems',
            'business_phone' => '9591989321',
            'status' => 'Approved',
        ]);
    }
}
