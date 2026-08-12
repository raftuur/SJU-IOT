<?php

namespace App\Repositories;

use App\Models\RewardModel;

class RewardRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = new RewardModel();
    }

    /**
     * Ambil semua reward yang aktif
     */
    public function findAllActive(): array
    {
        return $this->model
            ->where('status', 'active')
            ->orderBy('created_at', 'DESC')
            ->findAll();
    }

    /**
     * Ambil detail reward
     */
    public function findById(int $id): ?array
    {
        return $this->model
            ->where('id', $id)
            ->first();
    }
}