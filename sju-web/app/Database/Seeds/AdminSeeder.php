<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        helper('text');

        $this->db->table('users')->insert([
            'uuid' => random_string('alnum', 32),
            'fullname' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@sju.com',
            'phone' => '081234567890',
            'password' => password_hash('admin123', PASSWORD_DEFAULT),
            'login_provider' => 'local',
            'google_id' => null,
            'avatar' => null,
            'role' => 'admin',
            'status' => 'active',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'last_login_at' => null,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'deleted_at' => null,
        ]);
    }
}