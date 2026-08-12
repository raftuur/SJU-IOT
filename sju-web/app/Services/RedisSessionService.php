<?php

namespace App\Services;

use Config\Services;

class RedisSessionService
{
    protected $redis;

    public function __construct()
    {
        $this->redis = Services::redis();
    }

    /**
     * Membuat session machine
     */
    public function createSession(
        string $machineCode,
        array $data,
        int $ttl = 600
    ): bool {

        return $this->redis->set(
            'session:' . $machineCode,
            json_encode($data),
            $ttl
        );
    }

    /**
     * Mengambil session machine
     */
    public function getSession(string $machineCode): ?array
    {
        $session = $this->redis->get('session:' . $machineCode);

        if (!$session) {
            return null;
        }

        return json_decode($session, true);
    }

    /**
     * Menghapus session machine
     */
    public function deleteSession(string $machineCode): bool
    {
        return (bool) $this->redis->del('session:' . $machineCode);
    }

    /**
     * Mengecek apakah machine sedang digunakan
     */
    public function isMachineBusy(string $machineCode): bool
    {
        return $this->redis->exists('session:' . $machineCode) > 0;
    }
}