<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Validation\AuthValidation;

class AuthService extends BaseService
{
    protected UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    /**
     * Login Validation Rules
     */
    public function loginRules(): array
    {
        return AuthValidation::login();
    }

    /**
     * Cari user berdasarkan email
     */
    public function findUserByEmail(string $email): ?array
    {
        return $this->userRepository->findByEmail($email);
    }

    /**
     * Verifikasi password
     */
    public function verifyPassword(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }

    /**
     * Simpan session login
     */
    public function createSession(array $user): void
    {
        session()->set([
            'isLoggedIn' => true,
            'userId'     => $user['id'],
            'uuid'       => $user['uuid'],
            'fullname'   => $user['fullname'],
            'username'   => $user['username'],
            'email'      => $user['email'],
            'role'       => $user['role'],
        ]);
    }

    /**
     * Hapus session login
     */
    public function destroySession(): void
    {
        session()->destroy();
    }

    /**
     * Cek apakah user sudah login
     */
    public function isLoggedIn(): bool
    {
        return session()->get('isLoggedIn') === true;
    }

    /**
     * Ambil role user login
     */
    public function getRole(): ?string
    {
        return session()->get('role');
    }

    /**
     * Ambil ID user login
     */
    public function getUserId(): ?int
    {
        return session()->get('userId');
    }
}