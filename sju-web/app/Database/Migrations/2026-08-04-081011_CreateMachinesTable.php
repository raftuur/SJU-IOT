<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMachinesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([

            'id' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],

            'uuid' => [
                'type'       => 'CHAR',
                'constraint' => 36,
            ],

            'machine_code' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
            ],

            'machine_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],

            'location' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],

            'latitude' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,7',
                'null'       => true,
            ],

            'longitude' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,7',
                'null'       => true,
            ],

            'ip_address' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],

            'firmware_version' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
            ],

            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['online', 'offline', 'maintenance'],
                'default'    => 'offline',
            ],

            'last_online' => [
                'type' => 'DATETIME',
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

            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],

        ]);

        $this->forge->addKey('id', true);

        $this->forge->addUniqueKey('uuid');
        $this->forge->addUniqueKey('machine_code');

        $this->forge->createTable('machines');
    }

    public function down()
    {
        $this->forge->dropTable('machines');
    }
}