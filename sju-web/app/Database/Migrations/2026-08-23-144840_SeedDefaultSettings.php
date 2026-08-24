<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SeedDefaultSettings extends Migration
{
    public function up()
    {
        $data = [
            [
                'key'         => 'system_name',
                'value'       => 'Sampah Jadi Uang',
                'group'       => 'system',
                'description' => 'Nama sistem aplikasi.',
            ],
            [
                'key'         => 'system_description',
                'value'       => 'Sistem Reverse Vending Machine berbasis Internet of Things.',
                'group'       => 'system',
                'description' => 'Deskripsi sistem aplikasi.',
            ],
            [
                'key'         => 'point_per_bottle',
                'value'       => '30',
                'group'       => 'point',
                'description' => 'Point yang diberikan untuk setiap botol valid.',
            ],
            [
                'key'         => 'minimum_point',
                'value'       => '100',
                'group'       => 'point',
                'description' => 'Minimal point yang diperlukan untuk penukaran.',
            ],
            [
                'key'         => 'ai_service_url',
                'value'       => 'http://127.0.0.1:8000',
                'group'       => 'ai',
                'description' => 'URL service AI untuk pengujian deteksi.',
            ],
            [
                'key'         => 'ai_confidence',
                'value'       => '70',
                'group'       => 'ai',
                'description' => 'Minimum confidence AI dalam persen.',
            ],
            [
                'key'         => 'ai_detection_status',
                'value'       => '1',
                'group'       => 'ai',
                'description' => 'Status fitur AI Detection.',
            ],
            [
                'key'         => 'communication_interval',
                'value'       => '10',
                'group'       => 'machine',
                'description' => 'Interval komunikasi machine dalam detik.',
            ],
            [
                'key'         => 'offline_timeout',
                'value'       => '60',
                'group'       => 'machine',
                'description' => 'Batas waktu machine sebelum dianggap offline.',
            ],
        ];

        $this->db->table('settings')->insertBatch($data);
    }

    public function down()
    {
        $this->db->table('settings')
            ->whereIn('key', [
                'system_name',
                'system_description',
                'point_per_bottle',
                'minimum_point',
                'ai_service_url',
                'ai_confidence',
                'ai_detection_status',
                'communication_interval',
                'offline_timeout',
            ])
            ->delete();
    }
}