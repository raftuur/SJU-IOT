<?php

namespace App\Repositories;

use App\Models\AiDetectionModel;

class AiDetectionRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = new AiDetectionModel();
    }

    /**
     * Ambil semua AI Detection
     */
    public function findAllWithFilter(string $keyword = '')
    {
        $builder = $this->model;

        if (! empty($keyword)) {

            $builder->groupStart()
                ->like('detection_id', $keyword)
                ->groupEnd();

        }

        return $builder
            ->orderBy('id', 'DESC')
            ->findAll();
    }

    /**
     * Detail AI Detection
     */
    public function getDetail(int $id): ?array
    {
        return $this->model
            ->where('id', $id)
            ->first();
    }

    /**
     * Simpan hasil AI
     */
    public function store(array $data)
    {
        return $this->create($data);
    }

    /**
     * Statistik AI Detection
     */
    public function getStatistics(): array
    {
        $total = $this->model->countAll();

        $valid = $this->model
            ->where('bottle', 1)
            ->countAllResults();

        $invalid = $this->model
            ->where('bottle', 0)
            ->countAllResults();

        $average = $this->model
            ->selectAvg('confidence', 'average')
            ->first();

        return [

            'total' => $total,

            'valid' => $valid,

            'invalid' => $invalid,

            'average_confidence' => $average['average'] ?? 0,

        ];
    }

    /**
     * Ambil Detection ID terakhir
     */
    public function getLastDetection(): ?array
    {
        return $this->model
            ->select('id, detection_id')
            ->orderBy('id', 'DESC')
            ->first();
    }

    /**
     * Simpan AI Detection
     */
    public function create(array $data): ?array
    {
        $this->model->insert($data);

        return $this->model->find(
            $this->model->getInsertID()
        );
    }
}