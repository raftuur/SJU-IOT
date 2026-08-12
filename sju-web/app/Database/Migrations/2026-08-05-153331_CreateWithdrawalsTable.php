<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateWithdrawalsTable extends Migration
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

            'withdrawal_code' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
            ],

            'user_id' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'unsigned'   => true,
            ],

            'wallet_id' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'unsigned'   => true,
            ],

            'amount' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],

            // Tujuan pencairan
            'bank_code' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],

            'account_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],

            'account_number' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],

            // Data Xendit
            'external_id' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],

            'xendit_disbursement_id' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],

            'reference_number' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],

            'status' => [
                'type'       => 'ENUM',
                'constraint' => [
                    'pending',
                    'processing',
                    'completed',
                    'failed',
                    'rejected'
                ],
                'default'    => 'pending',
            ],

            'failure_reason' => [
                'type' => 'TEXT',
                'null' => true,
            ],

            'requested_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],

            'processed_at' => [
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

        $this->forge->addUniqueKey('uuid');
        $this->forge->addUniqueKey('withdrawal_code');

        $this->forge->addKey('user_id');
        $this->forge->addKey('wallet_id');

        $this->forge->addForeignKey(
            'user_id',
            'users',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->addForeignKey(
            'wallet_id',
            'wallets',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->createTable('withdrawals');
    }

    public function down()
    {
        $this->forge->dropTable('withdrawals');
    }
}