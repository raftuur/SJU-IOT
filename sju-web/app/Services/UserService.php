<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService extends BaseService
{
    protected UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    /**
     * Cari user berdasarkan email
     */
    public function getByEmail(string $email): ?array
    {
        return $this->userRepository->findByEmail($email);
    }

    /**
     * Cari user berdasarkan username
     */
    public function getByUsername(string $username): ?array
    {
        return $this->userRepository->findByUsername($username);
    }

    /**
     * Cari user berdasarkan UUID
     */
    public function getByUuid(string $uuid): ?array
    {
        return $this->userRepository->findByUuid($uuid);
    }
}