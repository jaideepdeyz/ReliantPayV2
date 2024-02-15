<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Admin',
        //     'email' => 'admin@g.com',
        //     'password' => Hash::make('Password123#'),
        //     'role' => 'Admin',
        //     'is_active' => 'Yes',
        //     'is_approved' => 'Yes'
        // ]);
        $this->call(BaseUserSeeder::class);
        $this->call(AffiliateSeeder::class);
        $this->call(ProducServiceSeeder::class);
        $this->call(ServiceMasterSeeder::class);
        $this->call(AirlineSeeder::class);
        $this->call(AirportSeeder::class);
        $this->call(TrainStationSeeder::class);
        // $this->call(UsCityStateSeeder::class);
    }
}
