<?php

namespace App\Services;

use App\Repositories\RewardRedemptionRepository;

class RewardRedemptionService
{
    protected RewardRedemptionRepository $rewardRedemptionRepository;

    public function __construct()
    {
        $this->rewardRedemptionRepository = new RewardRedemptionRepository();
    }

    /**
     * Semua data redemption
     */
    public function getAll(string $keyword = '')
    {
        return $this->rewardRedemptionRepository->findAllWithRelation($keyword);
    }

    /**
     * Detail redemption
     */
    public function getDetail(int $id)
    {
        return $this->rewardRedemptionRepository->getDetail($id);
    }

    /**
     * Approve redemption
     */
    public function approve(int $id): bool
    {
        return $this->rewardRedemptionRepository->approve($id);
    }

    /**
     * Reject redemption
     */
    public function reject(int $id): bool
    {
        return $this->rewardRedemptionRepository->reject($id);
    }

    /**
     * Update status redemption
     */
    public function update(int $id, array $data)
    {
        return $this->rewardRedemptionRepository->update($id, $data);
    }

    /**
     * Membuat permintaan penukaran voucher
     */
    public function create(array $data): ?array
    {
        return $this->rewardRedemptionRepository
            ->create([
                'uuid'              => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'redemption_code'   => 'RDM' . date('YmdHis') . random_int(100,999),
                'user_id'           => $data['user_id'],
                'wallet_id'         => $data['wallet_id'],
                'voucher_id'        => $data['voucher_id'],
                'point'             => $data['point'],
                'status'            => 'pending',
                'redeemed_at'       => date('Y-m-d H:i:s'),
                'notes'             => $data['notes'] ?? null,
            ]);
    }
}