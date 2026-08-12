<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateWalletHistoriesTable extends Migration
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

            'wallet_id' => [
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

            'type' => [
                'type'       => 'ENUM',
                'constraint' => [
                    'earn',
                    'redeem',
                    'adjustment'
                ],
            ],

            'point' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],

            'balance_before' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],

            'balance_after' => [
                'type'       => 'INT',
                'constraint' => 11,
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

        $this->forge->addKey('wallet_id');

        $this->forge->addKey('transaction_id');

        $this->forge->addForeignKey(
            'wallet_id',
            'wallets',
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

        $this->forge->createTable('wallet_histories');
    }

    public function down()
    {
        $this->forge->dropTable('wallet_histories');
    }
}