<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RequestsSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create();

        // Get all documents from the document table
        $documents = $this->db->table('document')->select('document_name')->get()->getResultArray();
        $user = $this->db->table('users')->where('role', 'resident')->select('user_id')->get()->getResultArray();

        $data = [];

        for ($i = 0; $i < 5; $i++) {
            $doc = $faker->randomElement($documents);
            $users = $faker->randomElement($user);

            $data[] = [
                'request_id'     => 'REQ-' . uniqid(),
                'request_type'   => $doc['document_name'], // use the document primary key
                'requestor_id'   => $users['user_id'], 
                'firstname'      => $faker->firstName,
                'middle_initial' => $faker->randomElement(['A', 'B', 'C', null]),
                'lastname'       => $faker->lastName,
                'suffix'         => $faker->randomElement(['Jr.', 'Sr.', null]),
                'sex'            => $faker->randomElement(['M', 'F']),
                'purok'          => $faker->streetName,
                'contact_no'     => '0934343'. random_int(1000, 9999),
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
