<?php

namespace App\Services;

use App\Repositories\TransactionRepository;
use App\Services\WalletService;
use Ramsey\Uuid\Uuid;

class TransactionService extends BaseService
{
    protected TransactionRepository $transactionRepository;
    protected WalletService $walletService;

    public function __construct()
    {
        $this->transactionRepository = new TransactionRepository();
        $this->walletService = new WalletService();
    }

    /**
     * Detail transaksi
     */
    public function getDetail(int $id): ?array
    {
        return $this->transactionRepository
            ->findDetailById($id);
    }

    /**
     * Cari transaksi berdasarkan Machine Session
     */
    public function getByMachineSession(int $sessionId): ?array
    {
        return $this->transactionRepository
            ->findByMachineSessionId($sessionId);
    }

    /**
     * Mendapatkan seluruh transaksi milik user
     */
    public function getByUser(int $userId): array
    {
        return $this->transactionRepository
            ->findByUserId($userId);
    }

    /**
     * Mendapatkan transaksi user beserta filter
     */
    public function getUserTransactions(
        int $userId,
        ?string $search = null,
        ?string $status = null
    ): array {
        return $this->transactionRepository
            ->findUserTransactions(
                $userId,
                $search,
                $status
            );
    }

    /**
     * Membuat transaksi
     */
    public function createTransaction(array $data): ?array
    {
        $transaction = [

            'uuid' => Uuid::uuid4()->toString(),

            'transaction_code' => 'TRX' . date('YmdHis') . random_int(100, 999),

            'machine_session_id' => $data['machine_session_id'],

            'ai_detection_id' => $data['ai_detection_id'] ?? null,

            'user_id' => $data['user_id'],

            'machine_id' => $data['machine_id'],

            'weight' => $data['weight'],

            'bottle_count' => $data['bottle_count'],

            'point_earned' => $data['point_earned'],

            'detection_result' => $data['detection_result'] ?? 'valid',

            'confidence' => $data['confidence'] ?? 100,

            'failure_reason' => $data['failure_reason'] ?? null,

            'processing_time' => $data['processing_time'] ?? 0,

            'status' => $data['status'] ?? 'success',

        ];

        return $this->transactionRepository
            ->create($transaction);
    }

    /**
     * Membuat transaksi dari hasil AI Detection
     */
    public function createFromAiDetection(array $data): ?array
    {
        $transaction = $this->createTransaction([

            'machine_session_id' => $data['machine_session_id'],

            'user_id' => $data['user_id'],

            'machine_id' => $data['machine_id'],

            'ai_detection_id' => $data['ai_detection_id'],

            'weight' => $data['weight'],

            'bottle_count' => $data['bottle_count'],

            'point_earned' => $data['point_earned'],

            'detection_result' => 'valid',

            'confidence' => $data['confidence'] ?? 100,

            'processing_time' => $data['processing_time'] ?? 0,

            'status' => 'success',

        ]);

        if (! $transaction) {

            return null;

        }

        // Tambahkan point ke wallet user
        $this->walletService->addPoint(

            $data['user_id'],

            $transaction['id'],

            $data['point_earned'],

            'Point dari penukaran botol melalui AI Detection'

        );

        return $transaction;
    }
}