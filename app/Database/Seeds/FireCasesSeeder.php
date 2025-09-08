<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class FireCasesSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create();

        $yearMonth = date('Ym'); // e.g., 202509
        $entriesToGenerate = 30;

        for ($i = 1; $i <= $entriesToGenerate; $i++) {
            $caseNumber = str_pad($i, 4, '0', STR_PAD_LEFT); // e.g., 0001
            $caseID = "FC-{$yearMonth}-{$caseNumber}";

            $dateOccurrence = $faker->dateTimeBetween('-1 year', 'now');

            $data = [
                'case_id'              => $caseID,
                'date_occurrence'      => $dateOccurrence->format('Y-m-d H:i:s'),
                'date_report'          => $faker->dateTimeBetween($dateOccurrence, 'now')->format('Y-m-d H:i:s'),
                'exact_location'       => $faker->address,
                'cause_of_fire'        => $faker->randomElement([
                    'Electrical Fault',
                    'Unattended Cooking',
                    'Arson',
                    'Candle Left Unattended',
                    'Gas Leak',
                    'Overloaded Circuit',
                    'Children Playing with Matches'
                ]),
                'affected_households'  => $faker->numberBetween(1, 25),
                'type_of_occupancy'    => $faker->randomElement([
                    'Residential',
                    'Commercial',
                    'Industrial',
                    'Mixed-Use'
                ]),
                'casualties'           => $faker->numberBetween(0, 5),
                'affected_individuals' => $faker->numberBetween(1, 100),
                'created_at'           => date('Y-m-d H:i:s'),
                'updated_at'           => date('Y-m-d H:i:s'),
                'is_deleted'           => 0,
            ];

            $this->db->table('fire_cases')->insert($data);
        }
    }
}
