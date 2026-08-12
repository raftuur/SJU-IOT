<?php

namespace App\Repositories;

use App\Models\TransactionModel;

class TransactionRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = new TransactionModel();
    }

    /**
     * Ambil semua transaksi
     */
    public function findAllTransaction(): array
    {
        return $this->model
            ->orderBy('created_at', 'DESC')
            ->findAll();
    }

    /**
     * Detail transaksi
     */
    public function findDetailById(int $id): ?array
    {
        return $this->model
            ->select('
                transactions.*,

                machines.machine_name,
                machines.location,

                ai_detections.detection_id,
                ai_detections.bottle,
                ai_detections.cap,
                ai_detections.label,
                ai_detections.confidence,
                ai_detections.original_image,
                ai_detections.detected_image
            ')
            ->join(
                'machines',
                'machines.id = transactions.machine_id'
            )
            ->join(
                'ai_detections',
                'ai_detections.id = transactions.ai_detection_id',
                'left'
            )
            ->where('transactions.id', $id)
            ->first();
    }

    /**
     * Cari berdasarkan Machine Session
     */
    public function findByMachineSessionId(int $sessionId): ?array
    {
        return $this->model
            ->where('machine_session_id', $sessionId)
            ->first();
    }

    /**
     * Ambil semua transaksi berdasarkan User
     */
    public function findByUserId(int $userId): array
    {
        return $this->model
            ->select('
                transactions.*,
                machines.machine_name,
                machines.location
            ')
            ->join(
                'machines',
                'machines.id = transactions.machine_id'
            )
            ->where('transactions.user_id', $userId)
            ->orderBy('transactions.created_at', 'DESC')
            ->findAll();
    }

    /**
     * Ambil transaksi user beserta filter
     */
    public function findUserTransactions(
        int $userId,
        ?string $search = null,
        ?string $status = null
    ): array {
        $builder = $this->model
            ->select('
                transactions.*,
                machines.machine_name,
                machines.location
            ')
            ->join(
                'machines',
                'machines.id = transactions.machine_id'
            )
            ->where('transactions.user_id', $userId);

        if (!empty($search)) {
            $builder->like(
                'transactions.transaction_code',
                $search
            );
        }

        if (!empty($status)) {
            $builder->where(
                'transactions.status',
                $status
            );
        }

        return $builder
            ->orderBy('transactions.created_at', 'DESC')
            ->findAll();
    }

    /**
     * Cari berdasarkan Transaction Code
     */
    public function findByCode(string $code): ?array
    {
        return $this->model
            ->where('transaction_code', $code)
            ->first();
    }

    /**
     * Simpan transaksi
     */
    public function create(array $data): ?array
    {
        $this->model->insert($data);

        return $this->model->find($this->model->getInsertID());
    }
}