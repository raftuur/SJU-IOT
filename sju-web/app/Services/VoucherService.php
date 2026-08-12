<?php

namespace App\Services;

use App\Repositories\VoucherRepository;
use App\Services\WalletService;
use App\Services\RewardRedemptionService;

class VoucherService
{
    protected VoucherRepository $voucherRepository;

    public function __construct()
    {
        $this->voucherRepository = new VoucherRepository();
    }

    /**
     * Ambil semua voucher
     */
    public function getAll(): array
    {
        return $this->voucherRepository->findAllVoucher();
    }

    /**
     * Ambil voucher aktif
     */
    public function getActive(): array
    {
        return $this->voucherRepository->findActive();
    }

    /**
     * Detail voucher
     */
    public function getDetail(int $id): ?array
    {
        return $this->voucherRepository->findDetailById($id);
    }

    /**
     * Simpan voucher baru
     */
    public function create(array $data)
    {
        return $this->voucherRepository->create($data);
    }

    /**
     * Update voucher
     */
    public function update(int $id, array $data)
    {
        return $this->voucherRepository->update($id, $data);
    }

    /**
     * Hapus voucher
     */
    public function delete(int $id)
    {
        return $this->voucherRepository->delete($id);
    }

    /**
     * Proses penukaran voucher
     */
    public function redeemVoucher(
        int $userId,
        int $voucherId
    )
    {
        $voucher = $this->voucherRepository
            ->findDetailById($voucherId);

        if (!$voucher) {
            return [
                'success' => false,
                'message' => 'Voucher tidak ditemukan.',
            ];
        }

        if ($voucher['status'] !== 'active') {
            return [
                'success' => false,
                'message' => 'Voucher sedang tidak aktif.',
            ];
        }

        if ((int) $voucher['stock'] <= 0) {
            return [
                'success' => false,
                'message' => 'Stok voucher telah habis.',
            ];
        }

        $today = strtotime(date('Y-m-d'));
        $startDate = strtotime(date('Y-m-d', strtotime($voucher['start_date'])));
        $endDate = strtotime(date('Y-m-d', strtotime($voucher['end_date'])));

        if ($today < $startDate || $today > $endDate) {
            return [
                'success' => false,
                'message' => 'Voucher sudah tidak berlaku.',
            ];
        }

        $walletService = new WalletService();
        $wallet = $walletService->getByUser($userId);

        if (!$wallet) {
            return [
                'success' => false,
                'message' => 'Wallet tidak ditemukan.',
            ];
        }

        if ((int) $wallet['balance'] < (int) $voucher['point']) {
            return [
                'success' => false,
                'message' => 'Point Anda tidak mencukupi untuk menukarkan voucher ini.',
            ];
        }

        $rewardRedemptionService = new RewardRedemptionService();

        $redemption = $rewardRedemptionService->create([
            'user_id'    => $userId,
            'wallet_id'  => $wallet['id'],
            'voucher_id' => $voucher['id'],
            'point'      => $voucher['point'],
        ]);

        if (!$redemption) {
            return [
                'success' => false,
                'message' => 'Gagal membuat permintaan penukaran voucher.',
            ];
        }

        $walletUpdated = $walletService->deductPoint(
            $userId,
            $redemption['id'],
            (int) $voucher['point'],
            'Redeem voucher: ' . $voucher['title']
        );

        if (!$walletUpdated) {
            return [
                'success' => false,
                'message' => 'Gagal mengurangi point wallet.',
            ];
        }

        return [
            'success' => true,
            'message' => 'Permintaan penukaran voucher berhasil dikirim.',
            'redemption' => $redemption,
        ];
    }
}