<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterSensorLogsAddTimestamps extends Migration
{
    public function up()
    {
        $this->forge->addColumn('sensor_logs', [

            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'after' => 'created_at',
            ],

            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'after' => 'updated_at',
            ],

        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('sensor_logs', [
            'updated_at',
            'deleted_at'
        ]);
    }
}