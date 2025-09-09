<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddIsCenceledColumn extends Migration
{
    public function up()
    {
        $fields = [
            'is_canceled' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default'    => 0,
            ],
        ];

        $this->forge->addColumn('requests', $fields);
    }

    public function down()
    {
        //
    }
}
