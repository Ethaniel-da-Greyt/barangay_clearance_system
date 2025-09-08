<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CensusSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create();
        $data  = [];

        $prefix = date('Ym'); // e.g., 202509
        $numRecords = 100;

        for ($i = 1; $i <= $numRecords; $i++) {
            $residentId = $prefix . '-' . str_pad($i, 4, '0', STR_PAD_LEFT);

            $data[] = [
                'resident_id'    => $residentId,
                'firstname'      => $faker->firstName,
                'lastname'       => $faker->lastName,
                'middle_initial' => strtoupper($faker->randomLetter),
                'suffix'         => $faker->randomElement(['Jr.', 'Sr.', 'III', null]),
                'sex'            => $faker->randomElement(['M', 'F']),
                'purok'          => 'Purok ' . $faker->numberBetween(1, 10),
                'census_year'    => date('Y'),
                'is_deleted'     => 0,
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ];
        }

        $this->db->table('census')->truncate();      // Optional: clears old data
        $this->db->table('census')->insertBatch($data);
    }
}
