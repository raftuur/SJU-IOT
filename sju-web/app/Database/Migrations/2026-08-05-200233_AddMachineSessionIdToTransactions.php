<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddMachineSessionIdToTransactions extends Migration
{
    public function up()
    {
        if (! $this->db->fieldExists('machine_session_id', 'transactions')) {

            $this->forge->addColumn('transactions', [

                'machine_session_id' => [

                    'type'       => 'BIGINT',

                    'constraint' => 20,

                    'unsigned'   => true,

                    'null'       => true,

                    'after'      => 'machine_id',

                ],

            ]);

        }
    }

    public function down()
    {
        $this->forge->dropForeignKey(
            'transactions',
            'transactions_machine_session_id_foreign'
        );

        $this->forge->dropColumn(
            'transactions',
            'machine_session_id'
        );
    }
}