<?php

namespace Database\Seeders;

use App\Models\Airport;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AirportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Airport::truncate();

        $csvFile = fopen(base_path("database/datasets/reliantAirports.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                Airport::create([
                    "code" => $data['1'],
                    "lat" => $data['2'],
                    "lon" => $data['3'],
                    "name" => $data['4'],
                    "city" => $data['5'],
                    "state" => $data['6'],
                    "country" => $data['7'],
                    "woeid" => $data['8'],
                    "tz" => $data['9'],
                    "phone" => $data['10'],
                    "type" => $data['11'],
                    "email" => $data['12'],
                    "url" => $data['13'],
                    "runway_length" => $data['14'],
                    "elev" => $data['15'],
                    "icao" => $data['16'],
                    "direct_flights" => $data['17'],
                    "carriers" => $data['18'],
                    "ident" => $data['19'],
                ]);
            }
            $firstline = false;
        }

        fclose($csvFile);
    }
}
