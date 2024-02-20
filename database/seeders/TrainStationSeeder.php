<?php

namespace Database\Seeders;

use App\Models\TrainStation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrainStationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TrainStation::truncate();

        $csvFile = fopen(base_path("database/datasets/reliantTrainStations.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                TrainStation::create([
                    "station_code" => $data['1'],
                    "station_location" => $data['2'],
                ]);
            }
            $firstline = false;
        }

        fclose($csvFile);
    }
}
