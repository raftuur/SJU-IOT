<?php

namespace App\Repositories;

use App\Models\WalletHistoryModel;

class WalletHistoryRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = new WalletHistoryModel();
    }

    /**
     * Ambil riwayat berdasarkan Wallet ID
     */
    public function findByWalletId(int $walletId): array
    {
        return $this->model
            ->where('wallet_id', $walletId)
            ->orderBy('created_at', 'DESC')
            ->findAll();
    }

    /**
     * Ambil riwayat berdasarkan User ID
     */
    public function findByUserId(int $userId): array
    {
        return $this->model
            ->select('wallet_histories.*')
            ->join('wallets', 'wallets.id = wallet_histories.wallet_id')
            ->where('wallets.user_id', $userId)
            ->orderBy('wallet_histories.created_at', 'DESC')
            ->findAll();
    }

    /**
     * Simpan riwayat wallet
     */
    public function create(array $data): bool
    {
        return (bool) $this->model->insert($data);
    }
}