<?php

namespace App\Services;

use App\Repositories\RewardRepository;

class RewardService extends BaseService
{
    protected RewardRepository $rewardRepository;

    public function __construct()
    {
        $this->rewardRepository = new RewardRepository();
    }

    /**
     * Ambil semua reward yang aktif
     */
    public function getActiveRewards(): array
    {
        return $this->rewardRepository->findAllActive();
    }

    /**
     * Ambil detail reward
     */
    public function getDetail(int $id): ?array
    {
        return $this->rewardRepository->findById($id);
    }
}