<?php

namespace App\Repositories;

use App\Models\WalletModel;

class WalletRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = new WalletModel();
    }

    /**
     * Ambil semua wallet beserta user
     */
    public function findAllWithUser(): array
    {
        return $this->model
            ->select('wallets.*, users.fullname, users.username, users.email')
            ->join('users', 'users.id = wallets.user_id')
            ->findAll();
    }

    /**
     * Cari wallet berdasarkan ID
     */
    public function findById(int $id): ?array
    {
        return $this->model
            ->where('id', $id)
            ->first();
    }

    /**
     * Cari wallet berdasarkan User ID
     */
    public function findByUserId(int $userId): ?array
    {
        return $this->model
            ->where('user_id', $userId)
            ->first();
    }

    /**
     * Update balance wallet
     */
    public function updateBalance(
        int $walletId,
        int $balance,
        int $totalEarned
    ): bool
    {
        return $this->update($walletId, [

            'balance' => $balance,

            'total_earned' => $totalEarned,

        ]);
    }

    /**
     * Update balance setelah redeem voucher
     */
    public function updateBalanceRedeem(
        int $walletId,
        int $balance,
        int $totalRedeemed
    ): bool
    {
        return $this->update($walletId, [

            'balance'         => $balance,

            'total_redeemed'  => $totalRedeemed,

        ]);
    }

    /**
     * Update balance setelah withdrawal
     */
    public function updateBalanceWithdrawal(
        int $walletId,
        int $balance
    ): bool
    {
        return $this->update($walletId, [

            'balance' => $balance,

        ]);
    }

    /**
     * Cari detail wallet berdasarkan ID dengan data user
     */
    public function findDetailById(int $id): ?array
    {
        return $this->model
            ->select('wallets.*, users.fullname, users.username, users.email')
            ->join('users', 'users.id = wallets.user_id')
            ->where('wallets.id', $id)
            ->first();
    }
}