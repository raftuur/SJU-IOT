<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterMachinesAddRealtimeColumns extends Migration
{
    public function up()
    {
        $fields = [

            'last_weight' => [
                'type'       => 'DECIMAL',
                'constraint' => '8,2',
                'default'    => 0,
                'after'      => 'status',
            ],

            'last_bin_level' => [
                'type'       => 'INT',
                'constraint' => 3,
                'default'    => 0,
                'after'      => 'last_weight',
            ],

            'last_temperature' => [
                'type'       => 'DECIMAL',
                'constraint' => '5,2',
                'default'    => 0,
                'after'      => 'last_bin_level',
            ],

            'last_wifi_rssi' => [
                'type'       => 'INT',
                'constraint' => 5,
                'default'    => 0,
                'after'      => 'last_temperature',
            ],

            'last_voltage' => [
                'type'       => 'DECIMAL',
                'constraint' => '5,2',
                'default'    => 0,
                'after'      => 'last_wifi_rssi',
            ],

            'heartbeat_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'after' => 'last_voltage',
            ],

        ];

        $this->forge->addColumn('machines', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('machines', [
            'last_weight',
            'last_bin_level',
            'last_temperature',
            'last_wifi_rssi',
            'last_voltage',
            'heartbeat_at',
        ]);
    }
}