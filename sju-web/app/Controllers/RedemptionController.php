<?php

namespace App\Controllers;

use App\Services\RewardRedemptionService;

class RedemptionController extends BaseController
{
    protected RewardRedemptionService $rewardRedemptionService;

    public function __construct()
    {
        $this->rewardRedemptionService = new RewardRedemptionService();
    }

    /**
     * Daftar Redemption
     */
    public function index()
    {
        $keyword = trim($this->request->getGet('keyword') ?? '');

        return view('admin/redemption/index', [

            'title'         => 'Redemption',

            'pageTitle'     => 'Redemption',

            'pageSubtitle'  => 'Kelola penukaran voucher pengguna.',

            'keyword'       => $keyword,

            'redemptions'   => $this->rewardRedemptionService->getAll($keyword),

        ]);
    }

    /**
     * Detail Redemption
     */
    public function show($id)
    {
        $redemption = $this->rewardRedemptionService->getDetail((int) $id);

        if (!$redemption) {

            return redirect()
                ->to('/redemption')
                ->with('error', 'Data redemption tidak ditemukan.');

        }

        return view('admin/redemption/show', [

            'title'         => 'Detail Redemption',

            'pageTitle'     => 'Detail Redemption',

            'pageSubtitle'  => 'Informasi penukaran voucher.',

            'redemption'    => $redemption,

        ]);
    }

    /**
     * Approve Redemption
     */
    public function approve($id)
    {
        $success = $this->rewardRedemptionService->approve((int) $id);

        if (!$success) {

            return redirect()
                ->back()
                ->with('error', 'Gagal mengapprove redemption.');

        }

        return redirect()
            ->to('/redemption/' . $id)
            ->with('success', 'Redemption berhasil diapprove.');
    }

    /**
     * Reject Redemption
     */
    public function reject($id)
    {
        $success = $this->rewardRedemptionService->reject((int) $id);

        if (!$success) {

            return redirect()
                ->back()
                ->with('error', 'Gagal menolak redemption.');

        }

        return redirect()
            ->to('/redemption/' . $id)
            ->with('success', 'Redemption berhasil ditolak.');
    }
}