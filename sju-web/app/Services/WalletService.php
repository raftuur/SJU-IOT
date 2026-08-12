<?php

namespace App\Services;

use App\Repositories\WalletRepository;
use App\Repositories\WalletHistoryRepository;
use Config\Database;

class WalletService extends BaseService
{
    protected WalletRepository $walletRepository;

    protected WalletHistoryRepository $walletHistoryRepository;

    public function __construct()
    {
        $this->walletRepository = new WalletRepository();

        $this->walletHistoryRepository = new WalletHistoryRepository();
    }

    /**
     * Menambahkan point ke wallet pengguna
     */
    public function addPoint(
        int $userId,
        int $transactionId,
        int $point,
        string $description
    ): bool
    {
        $db = Database::connect();

        $db->transBegin();

        try {

            $wallet = $this->walletRepository->findByUserId($userId);

            if (!$wallet) {
                throw new \RuntimeException('Wallet tidak ditemukan.');
            }

            $balanceBefore = (int) $wallet['balance'];

            $balanceAfter = $balanceBefore + $point;

            $totalEarned = (int) $wallet['total_earned'] + $point;

            $this->walletRepository->updateBalance(
                $wallet['id'],
                $balanceAfter,
                $totalEarned
            );

            $this->walletHistoryRepository->create([

                'wallet_id'        => $wallet['id'],

                'transaction_id'   => $transactionId,

                'type'             => 'earn',

                'point'            => $point,

                'balance_before'   => $balanceBefore,

                'balance_after'    => $balanceAfter,

                'description'      => $description,

            ]);

            if ($db->transStatus() === false) {
                throw new \RuntimeException('Gagal menyimpan wallet.');
            }

            $db->transCommit();

            return true;

        } catch (\Throwable $e) {

            $db->transRollback();

            log_message('error', 'WalletService::addPoint -> '.$e->getMessage());

            return false;
        }
    }

    /**
     * Mengurangi point wallet pengguna
     */
    public function deductPoint(
        int $userId,
        int $redemptionId,
        int $point,
        string $description
    ): bool
    {
        $db = Database::connect();

        $db->transBegin();

        try {

            $wallet = $this->walletRepository->findByUserId($userId);

            if (!$wallet) {
                throw new \RuntimeException('Wallet tidak ditemukan.');
            }

            $balanceBefore = (int) $wallet['balance'];

            if ($balanceBefore < $point) {
                throw new \RuntimeException('Point tidak mencukupi.');
            }

            $balanceAfter = $balanceBefore - $point;

            $totalRedeemed = (int) $wallet['total_redeemed'] + $point;

            $this->walletRepository->updateBalanceRedeem(
                $wallet['id'],
                $balanceAfter,
                $totalRedeemed
            );

            $this->walletHistoryRepository->create([

                'wallet_id'       => $wallet['id'],

                'redemption_id'   => $redemptionId,

                'type'            => 'redeem',

                'point'           => $point,

                'balance_before'  => $balanceBefore,

                'balance_after'   => $balanceAfter,

                'description'     => $description,

            ]);

            if ($db->transStatus() === false) {
                throw new \RuntimeException('Gagal mengurangi point.');
            }

            $db->transCommit();

            return true;

        } catch (\Throwable $e) {

            $db->transRollback();

            log_message('error', 'WalletService::deductPoint -> ' . $e->getMessage());

            return false;
        }
    }

    /**
     * Mendapatkan wallet berdasarkan user
     */
    public function getByUser(int $userId)
    {
        return $this->walletRepository->findByUserId($userId);
    }

    /**
     * Mendapatkan riwayat transaksi wallet user
     */
    public function getHistory(int $userId)
    {
        return $this->walletHistoryRepository->findByUserId($userId);
    }
}