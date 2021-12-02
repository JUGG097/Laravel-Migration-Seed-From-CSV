<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // public_path points to the "public/" directory
        $csvFile = fopen(public_path("data/Company.csv"), "r");

        // Skips firstline since it contains the header (excel column names)
        $firstline = true;
        // Loop through the csv file line by line
        while (($data = fgetcsv($csvFile, 2000, ",")) !== false) {
            if (!$firstline) {
                Company::create([
                    // the first column of csv file corresponds to "0"
                    "name" => $data["0"],
                    "industry" => $data["1"],
                    "state" => $data["2"],
                    "country" => $data["3"],
                    "revenue" => $data["4"],
                ]);
            }
            $firstline = false;
        }

        fclose($csvFile);
    }
}
