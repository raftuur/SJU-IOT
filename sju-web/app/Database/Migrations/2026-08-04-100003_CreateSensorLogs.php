<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSensorLogs extends Migration
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

            'bin_level' => [
                'type'       => 'INT',
                'constraint' => 3,
                'default'    => 0,
            ],

            'temperature' => [
                'type'       => 'DECIMAL',
                'constraint' => '5,2',
                'default'    => 0,
            ],

            'wifi_rssi' => [
                'type'       => 'INT',
                'constraint' => 5,
                'default'    => 0,
            ],

            'voltage' => [
                'type'       => 'DECIMAL',
                'constraint' => '5,2',
                'default'    => 0,
            ],

            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],

        ]);

        $this->forge->addKey('id', true);

        $this->forge->addKey('machine_id');

        $this->forge->addForeignKey(
            'machine_id',
            'machines',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->createTable('sensor_logs');
    }

    public function down()
    {
        $this->forge->dropTable('sensor_logs');
    }
}