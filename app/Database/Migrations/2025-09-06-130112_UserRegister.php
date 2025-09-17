<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserRegister extends Migration
{
    public function up()
    {
        // $this->forge->addField([
        //     'id'               => [
        //         'type'           => 'INT',
        //         'unsigned'       => true,
        //         'auto_increment' => true
        //     ],
        //     'user_id' => [
        //         'type'     => 'TEXT',
        //     ],
        //     'firstname'        => [
        //         'type'       => 'VARCHAR',
        //         'constraint' => 100,
        //     ],
        //     'middle_initial'   => [
        //         'type'       => 'VARCHAR',
        //         'constraint' => 50,
        //         'null'       => true,
        //     ],
        //     'lastname'         => [
        //         'type'       => 'VARCHAR',
        //         'constraint' => 100,
        //     ],
        //     'sex'         => [
        //         'type'       => 'ENUM',
        //         'constraint' => ['M', 'F'],
        //     ],
        //     'purok'         => [
        //         'type'       => 'TEXT',
        //         'null' => true,
        //     ],
        //     'username'         => [
        //         'type'       => 'VARCHAR',
        //         'constraint' => 50,
        //         'unique'     => true,
        //     ],
        //     'password'         => [
        //         'type'       => 'VARCHAR',
        //         'constraint' => 255,
        //     ],
        //     'role'             => [
        //         'type'       => 'ENUM',
        //         'constraint' => ['admin', 'resident'],
        //         'default'    => 'resident',
        //     ],
        //     'photo'            => [
        //         'type'       => 'TEXT',
        //         'constraint' => 255,
        //         'null'       => true,
        //     ],
        //     'is_deleted'       => [
        //         'type'       => 'TINYINT',
        //         'constraint' => 1,
        //         'default'    => 0,
        //     ],
        //     'created_at'       => [
        //         'type' => 'DATETIME',
        //         'null' => true,
        //     ],
        //     'updated_at'       => [
        //         'type' => 'DATETIME',
        //         'null' => true,
        //     ],
        // ]);

        // $this->forge->addKey('id', true); // Primary key

        // // Foreign key: user_id referencing users.id (self-reference)
        // $this->forge->createTable('users');
    }

    public function down()
    {
        //
    }
}
