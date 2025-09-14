<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DocumentSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        $documents = [
            [
                'document_id' => uniqid('DOC-'),
                'document_name' => 'Barangay Certification (Old Resident)',
                'requirements' => "- Valid ID\n- School ID\n- Company/Office ID\n- Voter's ID\n- CTC",
                'fee' => 100.00,
                'created_at' => $now,
                'updated_at' => $now,
                'is_deleted' => 0,
            ],
            [
                'document_id' => uniqid('DOC-'),
                'document_name' => 'Barangay Certification (New Resident)',
                'requirements' => "- Valid ID\n- CTC\n- Endorsement from Purok Barangay Officials",
                'fee' => 100.00,
                'created_at' => $now,
                'updated_at' => $now,
                'is_deleted' => 0,
            ],
            [
                'document_id' => uniqid('DOC-'),
                'document_name' => 'Barangay Clearance',
                'requirements' => "- Valid ID\n- CTC",
                'fee' => 100.00,
                'created_at' => $now,
                'updated_at' => $now,
                'is_deleted' => 0,
            ],
            // [
            //     'document_id' => uniqid('DOC-'),
            //     'document_name' => 'Community Tax Certificate (CTC)',
            //     'requirements' => "- Valid ID\n- Latest copy of CTC",
            //     'fee' => null,
            //     'created_at' => $now,
            //     'updated_at' => $now,
            //     'is_deleted' => 0,
            // ],
            // [
            //     'document_id' => uniqid('DOC-'),
            //     'document_name' => 'Barangay Protection Order (BPO)',
            //     'requirements' => null,
            //     'fee' => null,
            //     'created_at' => $now,
            //     'updated_at' => $now,
            //     'is_deleted' => 0,
            // ],
            // [
            //     'document_id' => uniqid('DOC-'),
            //     'document_name' => 'Filing Complaints',
            //     'requirements' => null,
            //     'fee' => 100.00,
            //     'created_at' => $now,
            //     'updated_at' => $now,
            //     'is_deleted' => 0,
            // ],
            // [
            //     'document_id' => uniqid('DOC-'),
            //     'document_name' => 'Certification to File Action',
            //     'requirements' => null,
            //     'fee' => 100.00,
            //     'created_at' => $now,
            //     'updated_at' => $now,
            //     'is_deleted' => 0,
            // ],
            // [
            //     'document_id' => uniqid('DOC-'),
            //     'document_name' => 'Certification to Bar Action',
            //     'requirements' => null,
            //     'fee' => 100.00,
            //     'created_at' => $now,
            //     'updated_at' => $now,
            //     'is_deleted' => 0,
            // ],
            // [
            //     'document_id' => uniqid('DOC-'),
            //     'document_name' => 'Certification to Bar Counterclaim',
            //     'requirements' => null,
            //     'fee' => 100.00,
            //     'created_at' => $now,
            //     'updated_at' => $now,
            //     'is_deleted' => 0,
            // ],
        ];

        $this->db->table('document')->insertBatch($documents);
    }
}
