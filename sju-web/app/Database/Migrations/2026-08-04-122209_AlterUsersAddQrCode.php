<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterUsersAddQrCode extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [

            'qr_code' => [

                'type'       => 'VARCHAR',

                'constraint' => 100,

                'null'       => true,

                'unique'     => true,

                'after'      => 'email',

            ],

        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('users', 'qr_code');
    }
}