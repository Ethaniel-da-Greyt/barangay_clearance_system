<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Population extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'               => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'resident_id' => [
                'type'     => 'TEXT',
            ],
            'firstname'        => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'lastname'         => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'middle_initial'   => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'suffix'   => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'sex'         => [
                'type'       => 'ENUM',
                'constraint' => ['M', 'F'],
            ],
            'purok'         => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'census_year'    => [
                'type'       => 'YEAR',
                'null'       => false,
            ],
            'is_deleted'       => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 0,
            ],
            'created_at'       => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at'       => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true); // Primary key

        $this->forge->createTable('census');
    }

    public function down()
    {
        //
    }
}
