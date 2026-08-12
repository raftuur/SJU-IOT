<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAiDetectionsTable extends Migration
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

            'detection_id' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
            ],

            'bottle' => [
                'type'    => 'BOOLEAN',
                'default' => false,
            ],

            'cap' => [
                'type'    => 'BOOLEAN',
                'default' => false,
            ],

            'label' => [
                'type'    => 'BOOLEAN',
                'default' => false,
            ],

            'confidence' => [
                'type'       => 'DECIMAL',
                'constraint' => '5,4',
                'default'    => 0,
            ],

            'original_image' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],

            'detected_image' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],

            'json_result' => [
                'type' => 'LONGTEXT',
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
        $this->forge->addUniqueKey('detection_id');

        $this->forge->createTable('ai_detections');
    }

    public function down()
    {
        $this->forge->dropTable('ai_detections');
    }
}