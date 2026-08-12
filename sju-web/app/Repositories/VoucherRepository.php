<?php

namespace App\Repositories;

use App\Models\VoucherModel;

class VoucherRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = new VoucherModel();
    }

    /**
     * Semua voucher yang belum dihapus
     */
    public function findAllVoucher(): array
    {
        return $this->model
            ->orderBy('created_at', 'DESC')
            ->findAll();
    }

    /**
     * Voucher aktif
     */
    public function findActive(): array
    {
        return $this->model
            ->where('status', 'active')
            ->where('deleted_at', null)
            ->orderBy('point', 'ASC')
            ->findAll();
    }

    /**
     * Detail voucher
     */
    public function findDetailById(int $id): ?array
    {
        return $this->model
            ->where('id', $id)
            ->first();
    }
}