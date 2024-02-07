<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['service_name' => 'Flight Booking'],
            ['service_name' => 'AMTRAK Booking'],
        ];

        \App\Models\ServiceMaster::insert($data);
    }
}
