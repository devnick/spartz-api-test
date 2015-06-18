<?php

use Illuminate\Database\Seeder;
use Spartz\City;
use Spartz\State;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $handle = fopen(database_path() . '/migrations/csv/cities.csv', 'r');

        fgets($handle);

        while (($row = fgetcsv($handle, 1000, ',')) !== FALSE)
        {
            $state = State::firstOrCreate([
                'name' => $row[2]
            ]);

            $city = City::create([
                'name'     => $row[1],
                'status'   => $row[3],
                'lat'      => $row[4],
                'lng'      => $row[5]
            ]);

            $city->state()->associate($state);

            $city->save();
        }

        fclose($handle);
    }
}
