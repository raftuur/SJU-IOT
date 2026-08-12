<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterWithdrawalsAddPointUsed extends Migration
{
    public function up()
    {
        $this->forge->addColumn('withdrawals', [

            'point_used' => [

                'type'       => 'INT',

                'constraint' => 11,

                'after'      => 'wallet_id',

            ],

        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('withdrawals', 'point_used');
    }
}