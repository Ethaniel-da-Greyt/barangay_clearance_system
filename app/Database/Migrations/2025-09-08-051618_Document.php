<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Document extends Migration
{
    public function up()
    {
        // $this->forge->addField([
        //     'id' => [
        //         'type'           => 'INT',
        //         'constraint'     => 11,
        //         'unsigned'       => true,
        //         'auto_increment' => true,
        //     ],
        //     'document_id' => [
        //         'type'       => 'TEXT',
        //         'null'       => false,
        //         'unique'     => true,
        //     ],
        //     'document_name'      => [
        //         'type'       => 'VARCHAR',
        //         'constraint' => 100,
        //     ],
        //     'requirements'         => [
        //         'type'       => 'TEXT',
        //         'null'       => true,
        //     ],
        //     'fee' => [
        //         'type'       => 'DECIMAL',
        //         'constraint' => '10,2',
        //         'null'       => true,
        //     ],
        //     'created_at' => [
        //         'type' => 'DATETIME',
        //         'null' => false,
        //     ],
        //     'updated_at' => [
        //         'type' => 'DATETIME',
        //         'null' => false,
        //     ],
        //     'is_deleted' => [
        //         'type' => 'TINYINT',
        //         'constraint' => 1,
        //         'default'    => 0,
        //     ],
        // ]);

        // $this->forge->addKey('id', true); // Primary key
        // $this->forge->createTable('document');
    }

    public function down()
    {
        //
    }
}
