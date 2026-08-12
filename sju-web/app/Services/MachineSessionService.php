<?php

namespace App\Services;

use App\Repositories\MachineSessionRepository;
use Ramsey\Uuid\Uuid;

class MachineSessionService extends BaseService
{
    protected MachineSessionRepository $machineSessionRepository;

    public function __construct()
    {
        $this->machineSessionRepository = new MachineSessionRepository();
    }

    /**
     * Semua Session
     */
    public function getAll(): array
    {
        return $this->machineSessionRepository->findAllSession();
    }

    /**
     * Detail Session
     */
    public function getDetail(int $id): ?array
    {
        return $this->machineSessionRepository->findDetail($id);
    }

    /**
     * Session aktif berdasarkan Machine
     */
    public function getActiveMachine(int $machineId): ?array
    {
        return $this->machineSessionRepository->findActiveByMachine($machineId);
    }

    /**
     * Session aktif berdasarkan User
     */
    public function getActiveUser(int $userId): ?array
    {
        return $this->machineSessionRepository->findActiveByUser($userId);
    }

    /**
     * Cari Session berdasarkan Token
     */
    public function getByToken(string $token): ?array
    {
        return $this->machineSessionRepository->findByToken($token);
    }

    /**
     * Membuat Session Baru
     */
    public function create(int $machineId, int $userId): ?array
    {
        if ($this->getActiveMachine($machineId)) {
            return null;
        }

        if ($this->getActiveUser($userId)) {
            return null;
        }

        $sessionToken = bin2hex(random_bytes(32));

        $data = [

            'uuid' => Uuid::uuid4()->toString(),

            'machine_id' => $machineId,

            'user_id' => $userId,

            'session_token' => $sessionToken,

            'status' => 'active',

            'total_bottle' => 0,

            'total_weight' => 0,

            'total_point' => 0,

            'started_at' => date('Y-m-d H:i:s'),

        ];

        $this->machineSessionRepository->createSession($data);

        return $this->machineSessionRepository->findByToken($sessionToken);
    }

    /**
     * Update progress session
     */
    public function updateProgress(
        int $id,
        int $bottle,
        float $weight,
        int $point
    ): bool {

        return $this->machineSessionRepository->updateSession($id, [

            'total_bottle' => $bottle,

            'total_weight' => $weight,

            'total_point' => $point,

        ]);
    }

    /**
     * Selesaikan Session
     */
    public function finish(int $id, int $transactionId): bool
    {
        return $this->machineSessionRepository->finishSession($id, [

            'transaction_id' => $transactionId,

            'status' => 'completed',

            'completed_at' => date('Y-m-d H:i:s'),

        ]);
    }

    /**
     * Batalkan Session
     */
    public function cancel(int $id): bool
    {
        return $this->machineSessionRepository->cancelSession($id);
    }
}