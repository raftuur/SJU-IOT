<?php

namespace App\Repositories;

use App\Models\UserModel;

class UserRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = new UserModel();
    }

    public function findByEmail(string $email)
    {
        return $this->model
            ->where('email', $email)
            ->first();
    }

    public function findByUsername(string $username)
    {
        return $this->model
            ->where('username', $username)
            ->first();
    }

    /**
     * Cari user berdasarkan UUID
     */
    public function findByUuid(string $uuid): ?array
    {
        return $this->model
            ->where('uuid', $uuid)
            ->first();
    }
}