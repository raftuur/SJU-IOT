<?php

namespace App\Services;

use App\Repositories\MachineRepository;

class MachineService extends BaseService
{
    protected MachineRepository $machineRepository;

    public function __construct()
    {
        $this->machineRepository = new MachineRepository();
    }

    /**
     * Ambil semua mesin
     */
    public function getAll(): array
    {
        return $this->machineRepository->findAllMachine();
    }

    /**
     * Ambil mesin online
     */
    public function getOnline(): array
    {
        return $this->machineRepository->findOnline();
    }

    /**
     * Detail mesin
     */
    public function getDetail(int $id): ?array
    {
        return $this->machineRepository->findDetailById($id);
    }

    /**
     * Cari mesin berdasarkan kode
     */
    public function getByMachineCode(string $machineCode): ?array
    {
        return $this->machineRepository->findByMachineCode($machineCode);
    }
}