<?php

namespace App\Services;

use App\Repositories\WithdrawalRepository;
use App\Repositories\WalletRepository;
use App\Repositories\WalletHistoryRepository;
use Config\Database;

class WithdrawalService
{
    protected WithdrawalRepository $withdrawalRepository;
    protected WalletRepository $walletRepository;
    protected WalletHistoryRepository $walletHistoryRepository;

    public function __construct()
    {
        $this->withdrawalRepository = new WithdrawalRepository();
        $this->walletRepository = new WalletRepository();
        $this->walletHistoryRepository = new WalletHistoryRepository();
    }

    /**
     * Semua data withdrawal
     */
    public function getAll(string $keyword = '')
    {
        return $this->withdrawalRepository->findAllWithRelation($keyword);
    }

    /**
     * Statistik Withdrawal
     */
    public function getStatistics(): array
    {
        return $this->withdrawalRepository->getStatistics();
    }

    /**
     * Approve Withdrawal
     */
    public function approve(int $id): bool
    {
        return $this->withdrawalRepository->approve($id);
    }

    /**
     * Detail Withdrawal
     */
    public function getDetail(int $id)
    {
        return $this->withdrawalRepository->getDetail($id);
    }

    /**
     * Membuat pengajuan withdrawal
     */
    public function create(array $data)
    {
        return $this->withdrawalRepository->create($data);
    }

    /**
     * Submit withdrawal user
     */
    public function submitWithdrawal(
        int $userId,
        array $data
    ): array
    {
        $db = Database::connect();

        $db->transBegin();

        try {

            $wallet = $this->walletRepository
                ->findByUserId($userId);

            if (! $wallet) {

                throw new \RuntimeException(
                    'Wallet tidak ditemukan.'
                );

            }

            $point = (int) $data['amount'];

            if ($point <= 0) {

                throw new \RuntimeException(
                    'Jumlah point tidak valid.'
                );

            }

            if ($wallet['balance'] < $point) {

                throw new \RuntimeException(
                    'Saldo point tidak mencukupi.'
                );

            }

            $config = config('Sju');

            $amount = $point * $config->pointRate;

            $balanceBefore = (int) $wallet['balance'];

            $balanceAfter = $balanceBefore - $point;

            $this->withdrawalRepository->create([

                'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),

                'withdrawal_code' => 'WDL' . date('YmdHis') . random_int(100,999),

                'user_id' => $userId,

                'wallet_id' => $wallet['id'],

                'point_used' => $point,

                'amount' => $amount,

                'bank_code' => $data['bank_code'],

                'account_name' => $data['account_name'],

                'account_number' => $data['account_number'],

                'status' => 'pending',

                'requested_at' => date('Y-m-d H:i:s'),

            ]);

            $this->walletRepository->updateBalanceWithdrawal(

                $wallet['id'],

                $balanceAfter

            );

            $this->walletHistoryRepository->create([

                'wallet_id'       => $wallet['id'],

                'transaction_id'  => null,

                'type'            => 'withdraw',

                'point'           => $point,

                'balance_before'  => $balanceBefore,

                'balance_after'   => $balanceAfter,

                'description'     => 'Pengajuan withdrawal',

            ]);

            if ($db->transStatus() === false) {

                throw new \RuntimeException(
                    'Gagal menyimpan data withdrawal.'
                );

            }

            $db->transCommit();

            return [
                'success' => true,
                'wallet'  => $wallet,
                'point'   => $point,
                'db'      => $db,
            ];

        } catch (\Throwable $e) {

            $db->transRollback();

            return [

                'success' => false,

                'message' => $e->getMessage(),

            ];

        }
    }

    /**
     * Validasi saldo wallet user
     */
    public function validateBalance(array $wallet, int $amount): bool
    {
        if ($amount <= 0) {
            return false;
        }

        return (int) $wallet['balance'] >= $amount;
    }

    /**
     * Semua withdrawal milik user
     */
    public function getByUser(int $userId)
    {
        return $this->withdrawalRepository
            ->findByUser($userId);
    }
}