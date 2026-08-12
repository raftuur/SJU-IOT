<?php

namespace App\Services;

use App\Repositories\AiDetectionRepository;
use App\Services\TransactionService;

class AiDetectionService
{
    protected AiDetectionRepository $aiDetectionRepository;
    protected TransactionService $transactionService;

    public function __construct()
    {
        $this->aiDetectionRepository = new AiDetectionRepository();
        $this->transactionService = new TransactionService();
    }

    /**
     * Semua AI Detection
     */
    public function getAll(string $keyword = '')
    {
        return $this->aiDetectionRepository
            ->findAllWithFilter($keyword);
    }

    /**
     * Detail AI Detection
     */
    public function getDetail(int $id)
    {
        return $this->aiDetectionRepository
            ->getDetail($id);
    }

    /**
     * Statistik AI Detection
     */
    public function getStatistics(): array
    {
        return $this->aiDetectionRepository
            ->getStatistics();
    }

    /**
     * Generate Detection ID
     * Format: AI202608060001
     */
    public function generateDetectionId(): string
    {
        $last = $this->aiDetectionRepository->getLastDetection();

        $date = date('Ymd');

        if (! $last || empty($last['detection_id'])) {

            return 'AI' . $date . '0001';

        }

        $lastId = $last['detection_id'];

        // Ambil tanggal dari Detection ID terakhir
        $lastDate = substr($lastId, 2, 8);

        // Ambil nomor urut
        $lastNumber = (int) substr($lastId, -4);

        if ($lastDate !== $date) {

            return 'AI' . $date . '0001';

        }

        $nextNumber = $lastNumber + 1;

        return 'AI' . $date . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Simpan hasil AI
     */
    public function store(array $data): ?array
    {
        return $this->aiDetectionRepository
            ->create($data);
    }

    /**
     * Simpan AI Detection lalu buat Transaction
     */
    public function storeAndCreateTransaction(
        array $aiData,
        array $transactionData
    ): array {

        // Simpan AI Detection
        $detection = $this->store($aiData);

        if (! $detection) {

            return [

                'success' => false,

                'message' => 'Gagal menyimpan AI Detection.'

            ];

        }

        // Hubungkan AI Detection ke Transaction
        $transactionData['ai_detection_id'] = $detection['id'];

        $transaction = $this->transactionService
            ->createFromAiDetection($transactionData);

        return [

            'success' => true,

            'detection' => $detection,

            'transaction' => $transaction

        ];
    }
}