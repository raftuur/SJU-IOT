<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMachineSessionsTable extends Migration
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
                'type'       => 'VARCHAR',
                'constraint' => 36,
            ],

            'machine_id' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'unsigned'   => true,
            ],

            'user_id' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'unsigned'   => true,
            ],

            'transaction_id' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'unsigned'   => true,
                'null'       => true,
            ],

            'session_token' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],

            'status' => [
                'type'       => 'ENUM',
                'constraint' => [
                    'waiting',
                    'active',
                    'completed',
                    'cancelled',
                    'timeout',
                ],
                'default' => 'waiting',
            ],

            'total_bottle' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
            ],

            'total_weight' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'default'    => 0,
            ],

            'total_point' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
            ],

            'started_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],

            'completed_at' => [
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

        $this->forge->addKey('uuid');

        $this->forge->addKey('machine_id');

        $this->forge->addKey('user_id');

        $this->forge->addKey('transaction_id');

        $this->forge->addKey('status');

        $this->forge->addForeignKey(
            'machine_id',
            'machines',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->addForeignKey(
            'user_id',
            'users',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->addForeignKey(
            'transaction_id',
            'transactions',
            'id',
            'SET NULL',
            'CASCADE'
        );

        $this->forge->createTable('machine_sessions');
    }

    public function down()
    {
        $this->forge->dropTable('machine_sessions', true);
    }
}