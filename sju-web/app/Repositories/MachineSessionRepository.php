<?php

namespace App\Repositories;

use App\Models\MachineSessionModel;

class MachineSessionRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = new MachineSessionModel();
    }

    /**
     * Session aktif berdasarkan Machine
     */
    public function findActiveByMachine(int $machineId): ?array
    {
        return $this->model
            ->where('machine_id', $machineId)
            ->where('status', 'active')
            ->first();
    }

    /**
     * Session aktif berdasarkan User
     */
    public function findActiveByUser(int $userId): ?array
    {
        return $this->model
            ->where('user_id', $userId)
            ->where('status', 'active')
            ->first();
    }

    /**
     * Semua Session Aktif
     */
    public function findActiveSessions(): array
    {
        return $this->model
            ->where('status', 'active')
            ->findAll();
    }

    /**
     * Cari Session berdasarkan Token
     */
    public function findByToken(string $token): ?array
    {
        return $this->model
            ->where('session_token', $token)
            ->first();
    }

    /**
     * Detail Session
     */
    public function findDetail(int $id): ?array
    {
        return $this->model->find($id);
    }

    /**
     * Semua Session
     */
    public function findAllSession(): array
    {
        return $this->model
            ->orderBy('created_at', 'DESC')
            ->findAll();
    }

    /**
     * Membuat Session Baru
     */
    public function createSession(array $data): bool
    {
        return (bool) $this->model->insert($data);
    }

    /**
     * Update Session
     */
    public function updateSession(int $id, array $data): bool
    {
        return $this->model->update($id, $data);
    }

    /**
     * Selesaikan Session
     */
    public function finishSession(int $id, array $data): bool
    {
        return $this->model->update($id, $data);
    }

    /**
     * Batalkan Session
     */
    public function cancelSession(int $id): bool
    {
        return $this->model->update($id, [

            'status' => 'cancelled',

            'completed_at' => date('Y-m-d H:i:s'),

        ]);
    }
}