<?php

namespace Database\Seeders;

use App\Models\UsCityState;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsCityStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UsCityState::truncate();

        $csvFile = fopen(base_path("database/datasets/reliantUScityStates.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                UsCityState::create([
                    "city" => $data['1'],
                    "state_code" => $data['2'],
                    "state_name" => $data['3'],
                ]);
            }
            $firstline = false;
        }

        fclose($csvFile);
    }
}
