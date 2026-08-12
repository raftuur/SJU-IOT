<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRewardRedemptionsTable extends Migration
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

            'redemption_code' => [
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

            'voucher_id' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'unsigned'   => true,
            ],

            'point' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],

            'status' => [
                'type'       => 'ENUM',
                'constraint' => [
                    'pending',
                    'approved',
                    'rejected',
                    'completed'
                ],
                'default'    => 'pending',
            ],

            'notes' => [
                'type' => 'TEXT',
                'null' => true,
            ],

            'redeemed_at' => [
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
        $this->forge->addUniqueKey('redemption_code');

        $this->forge->addKey('user_id');
        $this->forge->addKey('wallet_id');
        $this->forge->addKey('voucher_id');

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

        $this->forge->addForeignKey(
            'voucher_id',
            'vouchers',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->createTable('reward_redemptions');
    }

    public function down()
    {
        $this->forge->dropTable('reward_redemptions');
    }
}