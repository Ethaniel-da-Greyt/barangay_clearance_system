<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RequestsSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create();

        // Get all documents from the document table
        $documents = $this->db->table('document')->select('document_id')->get()->getResultArray();

        $data = [];

        for ($i = 0; $i < 5; $i++) {
            $doc = $faker->randomElement($documents);

            $data[] = [
                'request_id'     => 'REQ-' . uniqid(),
                'request_type'   => $doc['document_id'], // use the document primary key
                'firstname'      => $faker->firstName,
                'middle_initial' => $faker->randomElement(['A', 'B', 'C', null]),
                'lastname'       => $faker->lastName,
                'suffix'         => $faker->randomElement(['Jr.', 'Sr.', null]),
                'sex'            => $faker->randomElement(['M', 'F']),
                'purok'          => $faker->streetName,
                'contact_no'     => $faker->phoneNumber,
                'photo'          => null,
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
                'is_deleted'     => 0,
                'status'         => $faker->randomElement(['pending']),
            ];
        }

        $this->db->table('requests')->insertBatch($data);
    }
}
