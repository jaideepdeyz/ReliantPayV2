<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProducServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Flight Booking'],
            ['name' => 'AMTRAK Booking'],
        ];
        \App\Models\ProductService::insert($data);
    }
}
