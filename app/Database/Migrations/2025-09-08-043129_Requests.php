<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Requests extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'request_id' => [
                'type'       => 'TEXT',
                'null'       => false,
                'unique'     => true,
            ],
            'request_type'         => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'firstname'      => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'middle_initial' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'lastname'         => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'suffix' => [
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
            'contact_no' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'photo' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'is_deleted' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default'    => 0,
            ],
        ]);

        $this->forge->addKey('id', true); // Primary key
        $this->forge->createTable('requests');
    }

    public function down()
    {
        //
    }
}
