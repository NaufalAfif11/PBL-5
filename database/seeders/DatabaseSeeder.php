<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vaccine; // Import your Vaccine model

class VaccineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define the list of vaccine names to be seeded
        $vaccines = [
            ['name' => 'Vaksin A'],
            ['name' => 'Vaksin B'],
            ['name' => 'Vaksin C'],
            ['name' => 'Vaksin D'],
            ['name' => 'Vaksin E'],
        ];

        // Loop through each vaccine and create it if it doesn't already exist
        // Using firstOrCreate prevents duplicate entries if the seeder is run multiple times
        foreach ($vaccines as $vaccine) {
            Vaccine::firstOrCreate(
                ['name' => $vaccine['name']]
            );
        }
    }
}
