<?php

use Illuminate\Database\Seeder;
use Spartz\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $handle = fopen(database_path() . '/migrations/csv/users.csv', 'r');

        fgets($handle);

        while (($row = fgetcsv($handle, 1000, ',')) !== FALSE) {
            User::create([
                'first_name'=> $row[1],
                'last_name' => $row[2]
            ]);
        }

        fclose($handle);
    }
}
