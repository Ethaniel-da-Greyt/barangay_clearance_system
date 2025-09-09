<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumn extends Migration
{
    public function up()
    {
        $this->forge->addColumn('requests', [
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
                'after'      => 'contact_no'
            ],
        ]);
    }

    public function down()
    {
        //
    }
}
