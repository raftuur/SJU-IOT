<?php

namespace App\Repositories;

use App\Models\MachineModel;

class MachineRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = new MachineModel();
    }

    /**
     * Ambil semua mesin
     */
    public function findAllMachine(): array
    {
        return $this->model
            ->where('deleted_at', null)
            ->orderBy('machine_name', 'ASC')
            ->findAll();
    }

    /**
     * Ambil semua mesin online
     */
    public function findOnline(): array
    {
        return $this->model
            ->where('status', 'online')
            ->where('deleted_at', null)
            ->orderBy('machine_name', 'ASC')
            ->findAll();
    }

    /**
     * Detail mesin
     */
    public function findDetailById(int $id): ?array
    {
        return $this->model
            ->where('id', $id)
            ->first();
    }

    /**
     * Cari berdasarkan Machine Code
     */
    public function findByMachineCode(string $machineCode): ?array
    {
        return $this->model
            ->where('machine_code', $machineCode)
            ->first();
    }
}