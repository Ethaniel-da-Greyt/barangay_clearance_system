<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddEmailColumn extends Migration
{
    public function up()
    {
        $fields = [
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
                'after'      => 'contact_no'
            ],
        ];

        $this->forge->addColumn('requests', $fields);
    }

    public function down()
    {
        //
    }
}
