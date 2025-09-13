<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddNotifiedColumn extends Migration
{
    public function up()
    {
        $this->forge->addColumn('requests', [
            'notified' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default'    => 0,
            ]
        ]);
    }

    public function down()
    {
        //
    }
}
