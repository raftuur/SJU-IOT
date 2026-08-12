<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMachineLogs extends Migration
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

            'machine_id' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'unsigned'   => true,
            ],

            'activity' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],

            'description' => [
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

            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],

        ]);

        $this->forge->addKey('id', true);

        $this->forge->addKey('machine_id');

        $this->forge->addForeignKey(
            'machine_id',
            'machines',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->createTable('machine_logs');
    }

    public function down()
    {
        $this->forge->dropTable('machine_logs');
    }
}