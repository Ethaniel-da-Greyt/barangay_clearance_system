<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddIsCanceledColumn extends Migration
{
    public function up()
    {
        $this->forge->addColumn("requests", [
            'is_deleted' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default'    => 0,
            ],
        ]);
    }

    public function down()
    {
        //
    }
}
