<?php

namespace Database\Seeders;

use App\Models\Airline;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AirlineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Airline::truncate();

        $csvFile = fopen(base_path("database/datasets/reliantAirlines.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                Airline::create([
                    "code" => $data['1'],
                    "lcc" => $data['2'],
                    "name" => $data['3'],
                    "logo" => $data['4'],
                ]);
            }
            $firstline = false;
        }

        fclose($csvFile);
    }
}
