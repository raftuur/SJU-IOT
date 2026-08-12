<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTransactionsTable extends Migration
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

            'transaction_code' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
            ],

            'user_id' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'unsigned'   => true,
            ],

            'machine_id' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'unsigned'   => true,
            ],

            'weight' => [
                'type'       => 'DECIMAL',
                'constraint' => '8,2',
                'default'    => 0,
            ],

            'bottle_count' => [
                'type'       => 'INT',
                'constraint' => 5,
                'default'    => 0,
            ],

            'point_earned' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
            ],

            'detection_result' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],

            'confidence' => [
                'type'       => 'DECIMAL',
                'constraint' => '5,2',
                'default'    => 0,
            ],

            'failure_reason' => [
                'type' => 'TEXT',
                'null' => true,
            ],

            'processing_time' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
                'comment'    => 'Millisecond',
            ],

            'status' => [
                'type'       => 'ENUM',
                'constraint' => [
                    'success',
                    'failed',
                    'cancelled'
                ],
                'default' => 'success',
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

        $this->forge->addKey('uuid', false, true);

        $this->forge->addKey('transaction_code', false, true);

        $this->forge->addKey('user_id');

        $this->forge->addKey('machine_id');

        $this->forge->addForeignKey(
            'user_id',
            'users',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->addForeignKey(
            'machine_id',
            'machines',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->createTable('transactions');
    }

    public function down()
    {
        $this->forge->dropTable('transactions');
    }
}