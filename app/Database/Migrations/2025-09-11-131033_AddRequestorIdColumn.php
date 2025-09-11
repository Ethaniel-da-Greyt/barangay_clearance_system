<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddRequestorIdColumn extends Migration
{
    public function up()
    {
        $this->forge->addColumn('requests', [
            'requestor_id' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'after'      => 'request_type'
            ]
        ]);
    }

    public function down()
    {
        //
    }
}
