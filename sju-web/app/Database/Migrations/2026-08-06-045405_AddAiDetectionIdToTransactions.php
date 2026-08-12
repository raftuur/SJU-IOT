<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAiDetectionIdToTransactions extends Migration
{
    public function up()
    {
        $this->forge->addColumn('transactions', [

            'ai_detection_id' => [

                'type'       => 'BIGINT',

                'constraint' => 20,

                'unsigned'   => true,

                'null'       => true,

                'after'      => 'machine_session_id',

            ],

        ]);

        $this->db->query('
            ALTER TABLE transactions
            ADD CONSTRAINT fk_transactions_ai_detection
            FOREIGN KEY (ai_detection_id)
            REFERENCES ai_detections(id)
            ON UPDATE CASCADE
            ON DELETE SET NULL
        ');
    }

    public function down()
    {
        $this->db->query('
            ALTER TABLE transactions
            DROP FOREIGN KEY fk_transactions_ai_detection
        ');

        $this->forge->dropColumn(
            'transactions',
            'ai_detection_id'
        );
    }
}