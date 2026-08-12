<?php

namespace App\Repositories;

use App\Models\WithdrawalModel;

class WithdrawalRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = new WithdrawalModel();
    }

    /**
     * Semua withdrawal beserta user dan wallet
     */
    public function findAllWithRelation(string $keyword = '')
    {
        $builder = $this->model
            ->select('
                withdrawals.*,
                users.fullname,
                users.email,
                wallets.balance
            ')
            ->join('users', 'users.id = withdrawals.user_id')
            ->join('wallets', 'wallets.id = withdrawals.wallet_id');

        if (!empty($keyword)) {

            $builder->groupStart()
                ->like('withdrawals.withdrawal_code', $keyword)
                ->orLike('users.fullname', $keyword)
                ->orLike('users.email', $keyword)
                ->groupEnd();

        }

        return $builder
            ->orderBy('withdrawals.id', 'DESC')
            ->findAll();
    }

    /**
     * Semua withdrawal berdasarkan user
     */
    public function findByUser(int $userId): array
    {
        return $this->model
            ->select('
                withdrawals.*,
                wallets.balance
            ')
            ->join('wallets', 'wallets.id = withdrawals.wallet_id')
            ->where('withdrawals.user_id', $userId)
            ->orderBy('withdrawals.created_at', 'DESC')
            ->findAll();
    }

    /**
     * Detail Withdrawal
     */
    public function getDetail(int $id): ?array
    {
        return $this->model
            ->select('
                withdrawals.*,
                users.fullname,
                users.email,
                wallets.balance
            ')
            ->join('users', 'users.id = withdrawals.user_id')
            ->join('wallets', 'wallets.id = withdrawals.wallet_id')
            ->where('withdrawals.id', $id)
            ->first();
    }

    /**
     * Statistik Withdrawal
     */
    public function getStatistics(): array
    {
        return [

            'total' => $this->model->countAllResults(false),

            'pending' => $this->model
                ->where('status', 'pending')
                ->countAllResults(),

            'completed' => $this->model
                ->where('status', 'completed')
                ->countAllResults(),

            'rejected' => $this->model
                ->where('status', 'rejected')
                ->countAllResults(),

        ];
    }

    /**
     * Approve Withdrawal
     */
    public function approve(int $id): bool
    {
        return $this->model
            ->where('id', $id)
            ->set([
                'status'       => 'processing',
                'processed_at' => date('Y-m-d H:i:s'),
            ])
            ->update();
    }
}