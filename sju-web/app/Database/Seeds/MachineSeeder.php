<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MachineSeeder extends Seeder
{
    public function run()
    {
        $data = [

            [
                'uuid'             => bin2hex(random_bytes(16)),
                'machine_code'     => 'RVM001',
                'machine_name'     => 'RVM Fakultas Teknik',
                'location'         => 'Lobby Fakultas Teknik',
                'latitude'         => -3.3212345,
                'longitude'        => 114.5876543,
                'ip_address'       => '192.168.1.100',
                'firmware_version' => 'v2.0.0',
                'status'           => 'online',
            ],

            [
                'uuid'             => bin2hex(random_bytes(16)),
                'machine_code'     => 'RVM002',
                'machine_name'     => 'RVM Fakultas Teknik Informatika',
                'location'         => 'Lobby Fakultas Teknik Informatika',
                'latitude'         => -3.3000000,
                'longitude'        => 115.0456247,
                'ip_address'       => '192.168.1.101',
                'firmware_version' => 'v1.0.0',
                'status'           => 'maintenance',
            ],

            [
                'uuid'             => bin2hex(random_bytes(16)),
                'machine_code'     => 'RVM003',
                'machine_name'     => 'RVM Rektorat',
                'location'         => 'Lobby Rektorat',
                'latitude'         => -3.3212345,
                'longitude'        => 114.5876543,
                'ip_address'       => '192.168.1.102',
                'firmware_version' => 'v1.0.0',
                'status'           => 'offline',
            ],

        ];

        $this->db->table('machines')->insertBatch($data);
    }
}