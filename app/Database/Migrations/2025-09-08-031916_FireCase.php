<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FireCase extends Migration
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
        //     'case_id' => [
        //         'type'       => 'TEXT',
        //         'null'       => false,
        //         'unique'     => true,
        //     ],
        //     'date_occurrence' => [
        //         'type' => 'DATETIME',
        //         'null' => false,
        //     ],
        //     'date_report' => [
        //         'type' => 'DATETIME',
        //         'null' => false,
        //     ],
        //     'exact_location' => [
        //         'type'       => 'TEXT',
        //         'null'       => false,
        //     ],
        //     'cause_of_fire' => [
        //         'type'       => 'TEXT',
        //         'null'       => true,
        //     ],
        //     'affected_households' => [
        //         'type'       => 'INT',
        //         'constraint' => 11,
        //         'default'    => 0,
        //     ],
        //     'type_of_occupancy' => [
        //         'type'       => 'VARCHAR',
        //         'constraint' => 100,
        //         'null'       => true,
        //     ],
        //     'casualties' => [
        //         'type'       => 'INT',
        //         'constraint' => 11,
        //         'default'    => 0,
        //     ],
        //     'affected_individuals' => [
        //         'type'       => 'INT',
        //         'constraint' => 11,
        //         'default'    => 0,
        //     ],
        //     'created_at' => [
        //         'type' => 'DATETIME',
        //         'null' => true,
        //     ],
        //     'updated_at' => [
        //         'type' => 'DATETIME',
        //         'null' => true,
        //     ],
        //     'is_deleted' => [
        //         'type' => 'TINYINT',
        //         'constraint' => 1,
        //         'default'    => 0,
        //     ],
        // ]);

        // $this->forge->addKey('id', true); // Primary key
        // $this->forge->createTable('fire_cases');
    }

    public function down()
    {
        //
    }
}
